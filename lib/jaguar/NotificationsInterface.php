<?php

interface NotificationsInterface
{
  // este campo deve estar no model que implementar esta interface
  // /**
  //  * <b>infoBD:</b> smallint(16) default 1<br />
  //  * @var int
  //  */
  // public $id_notificado;

  /**
   * @return array(
   *   array(
   *     "classe"  => "",
   *     "id"      => "",
   *     "title"   => "",
   *     "options" => array(
   *       "body" => "",
   *       "icon" => "",
   *     ),
   *     "link"    => "",
   *   ),
   *   ...
   * );
   */
  public static function obterNotifications();
} 