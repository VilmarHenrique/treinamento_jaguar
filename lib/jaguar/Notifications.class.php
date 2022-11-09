<?php

class Notifications implements NotificationsInterface
{
  const DS_LINK = "<span id=\"notifications\">&nbsp&nbsp<a href=\"javascript:void(0);\" onClick=\"javascript:obterNotifications();\">Notificações</a>&nbsp&nbsp|</span>";

  public static function obterJS($intervalo = 5){

    $time = max((int)$intervalo * 1000, 5000);

    return <<<JS
      function obterNotifications() {

        if (!Notification) return;

        if (Notification.permission === 'granted') {

          $('#notifications').hide();

          var retorno = buscaDadosAjax('Notifications', 'obterNotifications', {}) || [];

          for (var i in retorno)
          {
            var obj = retorno[i];
            var link = obj.link;

            if (!notifications[link])
            {
              notifications[link] = new Notification(obj.title, obj.options);

              notifications[link].onclick = function () {
                window.open(link);
                notifications[link].close();
              };

              notifications[link].onclose = function () {
                buscaDadosAjax('Notifications', 'atualizarIdNotificado', {
                  classe: obj.classe,
                  id: obj.id
                });
                delete notifications[link];
              };
            }
          }
        }
        else
        {
          $('#notifications').show();

          Notification.requestPermission(function (permission) {
            obterNotifications();

            if (permission === 'denied')
              clearInterval(notificationsInterval);
          });
        }
      }

      var notifications = {};
      var notificationsInterval;

      $(function(){
        $('#notifications').hide();
        obterNotifications();

        notificationsInterval = setInterval(function(){
          obterNotifications();
        }, {$time});
      });
JS;
  }

  /**
   * @uses ajaxComplete
   * @return array
   */
  public static function obterNotifications()
  {
    $arrRetorno = array();

    if (str_value($_SESSION["s_cd_usuario"]))
      foreach (ifnull($_SESSION["s_notification_methods"], array()) as $method)
        $arrRetorno = array_merge($arrRetorno, call_user_func($method));

    return $arrRetorno;
  }

  /**
   * @uses ajaxComplete
   * @param $classe
   * @param $id
   */
  public static function atualizarIdNotificado($classe, $id)
  {
    $interfaces = class_implements($classe);

    if (isset($interfaces["NotificationsInterface"]))
    {
      $obj = new $classe(JDBConn::getInstance());
      $obj->{$obj->key[0]} = $id;
      $obj->id_notificado = 1;
      ManBD::getInstance()->salvar($obj);
    }
  }

  /**
   * @param array $arrMethods
   */
  public static function registrar(array $arrMethods)
  {
    $_SESSION["s_notification_methods"] = $arrMethods;
  }
}