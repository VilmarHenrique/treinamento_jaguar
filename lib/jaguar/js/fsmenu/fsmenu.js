/*

FREESTYLE MENUS v1.0 RC (c) 2001-2006 Angus Turnbull, http://www.twinhelix.com
Altering this notice or redistributing this file is prohibited.

*/

var isDOM=document.getElementById?1:0,isIE=document.all?1:0,isNS4=navigator.appName=='Netscape'&&!isDOM?1:0,isOp=self.opera?1:0,isDyn=isDOM||isIE||isNS4;
function getRef(i,p){
  p=!p?document:p.navigator?p.document:p;
  return isIE?p.all[i]:isDOM?(p.getElementById?p:p.ownerDocument).getElementById(i):isNS4?p.layers[i]:null
  };
  
function getSty(i,p){
  var r=getRef(i,p);
  return r?isNS4?r:r.style:null
  };
  
if(!self.LayerObj)var LayerObj=new Function('i','p','this.ref=getRef(i,p);this.sty=getSty(i,p);return this');
function getLyr(i,p){
  return new LayerObj(i,p)
  };
  
function LyrFn(n,f){
  LayerObj.prototype[n]=new Function('var a=arguments,p=a[0],px=isNS4||isOp?0:"px";with(this){'+f+'}')
  };
  
LyrFn('x','if(!isNaN(p))sty.left=p+px;else return parseInt(sty.left)');
LyrFn('y','if(!isNaN(p))sty.top=p+px;else return parseInt(sty.top)');
if(typeof addEvent!='function'){
  var addEvent=function(o,t,f,l){
    var d='addEventListener',n='on'+t,rO=o,rT=t,rF=f,rL=l;
    if(o[d]&&!l)return o[d](t,f,false);
    if(!o._evts)o._evts={};
      
    if(!o._evts[t]){
      o._evts[t]=o[n]?{
        b:o[n]
        }:{};
      
      o[n]=new Function('e','var r=true,o=this,a=o._evts["'+t+'"],i;for(i in a){o._f=a[i];r=o._f(e||window.event)!=false&&r;o._f=null}return r');
      if(t!='unload')addEvent(window,'unload',function(){
        removeEvent(rO,rT,rF,rL)
        })
      }
      if(!f._i)f._i=addEvent._i++;
    o._evts[t][f._i]=f
    };
    
  addEvent._i=1;
  var removeEvent=function(o,t,f,l){
    var d='removeEventListener';
    if(o[d]&&!l)return o[d](t,f,false);
    if(o._evts&&o._evts[t]&&f._i)delete o._evts[t][f._i]
  }
}
function FSMenu(myName,nested,cssProp,cssVis,cssHid){
  this.myName=myName;
  this.nested=nested;
  this.cssProp=cssProp;
  this.cssVis=cssVis;
  this.cssHid=cssHid;
  this.cssLitClass='highlighted';
  this.menus={
    root:new FSMenuNode('root',true,this)
    };
    
  this.menuToShow=[];
  this.mtsTimer=null;
  this.showDelay=0;
  this.switchDelay=125;
  this.hideDelay=500;
  this.showOnClick=0;
  this.hideOnClick=false;
  this.animInSpeed=0.2;
  this.animOutSpeed=0.2;
  this.animations=[]
  };
  
FSMenu.prototype.show=function(mN){
  with(this){
    menuToShow.length=arguments.length;
    for(var i=0;i<arguments.length;i++)menuToShow[i]=arguments[i];
    clearTimeout(mtsTimer);
    if(!nested)mtsTimer=setTimeout(myName+'.menus.root.over()',10)
      }
    };
  
FSMenu.prototype.hide=function(mN){
  with(this){
    clearTimeout(mtsTimer);
    if(menus[mN])menus[mN].out()
      }
    };
  
FSMenu.prototype.hideAll=function(){
  with(this){
    for(var m in menus)if(menus[m].visible&&!menus[m].isRoot)menus[m].hide(true)
      }
    };
  
function FSMenuNode(id,isRoot,obj){
  this.id=id;
  this.isRoot=isRoot;
  this.obj=obj;
  this.lyr=this.child=this.par=this.timer=this.visible=null;
  this.args=[];
  var node=this;
  this.over=function(evt){
    with(node)with(obj){
      if(isNS4&&evt&&lyr.ref)lyr.ref.routeEvent(evt);
      clearTimeout(timer);
      clearTimeout(mtsTimer);
      if(!isRoot&&!visible)node.show();
      if(menuToShow.length){
        var a=menuToShow,m=a[0];
        if(!menus[m]||!menus[m].lyr.ref)menus[m]=new FSMenuNode(m,false,obj);
        var c=menus[m];
        if(c==node){
          menuToShow.length=0;
          return
        }
        clearTimeout(c.timer);
        if(c!=child&&c.lyr.ref){
          c.args.length=a.length;
          for(var i=0;i<a.length;i++)c.args[i]=a[i];
          var delay=child?switchDelay:showDelay;
          c.timer=setTimeout('with('+myName+'){menus["'+c.id+'"].par=menus["'+node.id+'"];menus["'+c.id+'"].show()}',delay?delay:1)
          }
          menuToShow.length=0
        }
        if(!nested&&par)par.over()
        }
      };
    
this.out=function(evt){
  with(node)with(obj){
    if(isNS4&&evt&&lyr&&lyr.ref)lyr.ref.routeEvent(evt);
    clearTimeout(timer);
    if(!isRoot&&hideDelay>=0){
      timer=setTimeout(myName+'.menus["'+id+'"].hide()',hideDelay);
      if(!nested&&par)par.out()
        }
      }
};

if(this.id!='root')with(this)with(lyr=getLyr(id))if(ref){
  if(isNS4)ref.captureEvents(Event.MOUSEOVER|Event.MOUSEOUT);
  addEvent(ref,'mouseover',this.over);
  addEvent(ref,'mouseout',this.out);
  if(obj.nested){
    addEvent(ref,'focus',this.over);
    addEvent(ref,'click',this.over);
    addEvent(ref,'blur',this.out)
    }
  }
};

FSMenuNode.prototype.show=function(forced){
  with(this)with(obj){
    if(!lyr||!lyr.ref)return;
    if(par){
      if(par.child&&par.child!=this)par.child.hide();
      par.child=this
      }
      var offR=args[1],offX=args[2],offY=args[3],lX=0,lY=0,doX=''+offX!='undefined',doY=''+offY!='undefined';
    if(self.page&&offR&&(doX||doY)){
      with(page.elmPos(offR,par.lyr?par.lyr.ref:0))lX=x,lY=y;
      if(doX)lyr.x(lX+eval(offX));
      if(doY)lyr.y(lY+eval(offY))
        }
        if(offR)lightParent(offR,1);
    visible=1;
    if(obj.onshow)obj.onshow(id);
    lyr.ref.parentNode.style.zIndex='2';
    setVis(1,forced)
    }
  };
  
FSMenuNode.prototype.hide=function(forced){
  with(this)with(obj){
    if(!lyr||!lyr.ref||!visible)return;
    if(isNS4&&self.isMouseIn&&isMouseIn(lyr.ref))return show();
    if(args[1])lightParent(args[1],0);
    if(child)child.hide();
    if(par&&par.child==this)par.child=null;
    if(lyr){
      visible=0;
      if(obj.onhide)obj.onhide(id);
      lyr.ref.parentNode.style.zIndex='1';
      setVis(0,forced)
      }
    }
};

FSMenuNode.prototype.lightParent=function(elm,lit){
  with(this)with(obj){
    if(!cssLitClass||isNS4)return;
    if(lit)elm.className+=(elm.className?' ':'')+cssLitClass;else elm.className=elm.className.replace(new RegExp('(\\s*'+cssLitClass+')+$'),'')
      }
    };
  
FSMenuNode.prototype.setVis=function(sh,forced){
  with(this)with(obj){
    if(lyr.forced&&!forced)return;
    lyr.forced=forced;
    lyr.timer=lyr.timer||0;
    lyr.counter=lyr.counter||0;
    with(lyr){
      clearTimeout(timer);
      if(sh&&!counter)sty[cssProp]=cssVis;
      var speed=sh?animInSpeed:animOutSpeed;
      if(isDOM&&speed<1)for(var a=0;a<animations.length;a++)animations[a](ref,counter,sh);
      counter+=speed*(sh?1:-1);
      if(counter>1){
        counter=1;
        lyr.forced=false
        }else if(counter<0){
        counter=0;
        sty[cssProp]=cssHid;
        lyr.forced=false
        }else if(isDOM){
        timer=setTimeout(myName+'.menus["'+id+'"].setVis('+sh+','+forced+')',50)
        }
      }
  }
};

FSMenu.animSwipeDown=function(ref,counter,show){
  if(show&&(counter==0)){
    ref._fsm_styT=ref.style.top;
    ref._fsm_styMT=ref.style.marginTop;
    ref._fsm_offT=ref.offsetTop||0
    }
    var cP=Math.pow(Math.sin(Math.PI*counter/2),0.75);
  var clipY=ref.offsetHeight*(1-cP);
  ref.style.clip=(counter==1?((window.opera||navigator.userAgent.indexOf('KHTML')>-1)?'':'rect(auto,auto,auto,auto)'):'rect('+clipY+'px,'+ref.offsetWidth+'px,'+ref.offsetHeight+'px,0)');
  if(counter==1||(counter<0.01&&!show)){
    ref.style.top=ref._fsm_styT;
    ref.style.marginTop=ref._fsm_styMT
    }else{
    ref.style.top=((0-clipY)+(ref._fsm_offT))+'px';
    ref.style.marginTop='0'
    }
  };

FSMenu.animFade=function(ref,counter,show){
  var done=(counter==1);
  if(ref.filters){
    var alpha=!done?' alpha(opacity='+parseInt(counter*100)+')':'';
    if(ref.style.filter.indexOf("alpha")==-1)ref.style.filter+=alpha;else ref.style.filter=ref.style.filter.replace(/\s*alpha\([^\)]*\)/i,alpha)
      }else ref.style.opacity=ref.style.MozOpacity=counter/1.001
    };
    
FSMenu.animClipDown=function(ref,counter,show){
  var cP=Math.pow(Math.sin(Math.PI*counter/2),0.75);
  ref.style.clip=(counter==1?((window.opera||navigator.userAgent.indexOf('KHTML')>-1)?'':'rect(auto,auto,auto,auto)'):'rect(0,'+ref.offsetWidth+'px,'+(ref.offsetHeight*cP)+'px,0)')
  };
  
FSMenu.prototype.activateMenu=function(id,subInd){
  with(this){
    if(!isDOM||!document.documentElement)return;
    var fsmFB=getRef('fsmenu-fallback');
    if(fsmFB){
      fsmFB.rel='alternate stylesheet';
      fsmFB.disabled=true
      }
      var a,ul,li,parUL,mRoot=getRef(id),nodes,count=1;
    var lists=mRoot.getElementsByTagName('ul');
    for(var i=0;i<lists.length;i++){
      li=ul=lists[i];
      while(li){
        if(li.nodeName.toLowerCase()=='li')break;
        li=li.parentNode
        }
        if(!li)continue;
      parUL=li;
      while(parUL){
        if(parUL.nodeName.toLowerCase()=='ul')break;
        parUL=parUL.parentNode
        }
        a=null;
      for(var j=0;j<li.childNodes.length;j++)if(li.childNodes[j].nodeName.toLowerCase()=='a')a=li.childNodes[j];if(!a)continue;
      var menuID=myName+'-id-'+count++;
      if(ul.id)menuID=ul.id;else ul.setAttribute('id',menuID);
      var sOC=(showOnClick==1&&li.parentNode==mRoot)||(showOnClick==2);
      var evtProp=navigator.userAgent.indexOf('Safari')>-1||isOp?'safRtnVal':'returnValue';
      var eShow=new Function('with('+myName+'){var m=menus["'+menuID+'"],pM=menus["'+parUL.id+'"];'+(sOC?'if((pM&&pM.child)||(m&&m.visible))':'')+' show("'+menuID+'",this)}');
      var eHide=new Function('e','if(e.'+evtProp+'!=false)'+myName+'.hide("'+menuID+'")');
      addEvent(a,'mouseover',eShow);
      addEvent(a,'focus',eShow);
      addEvent(a,'mouseout',eHide);
      addEvent(a,'blur',eHide);
      if(sOC)addEvent(a,'click',new Function('e',myName+'.show("'+menuID+'",this);if(e.cancelable&&e.preventDefault)e.preventDefault();e.'+evtProp+'=false;return false'));
      if(subInd)a.insertBefore(subInd.cloneNode(true),a.firstChild)
        }
        if(isIE&&!isOp){
      var aNodes=mRoot.getElementsByTagName('a');
      for(var i=0;i<aNodes.length;i++){
        addEvent(aNodes[i],'focus',new Function('e','var node=this.parentNode;while(node){if(node.onfocus)node.onfocus(e);node=node.parentNode}'));
        addEvent(aNodes[i],'blur',new Function('e','var node=this.parentNode;while(node){if(node.onblur)node.onblur(e);node=node.parentNode}'))
        }
      }
      if(hideOnClick)addEvent(mRoot,'click',new Function(myName+'.hideAll()'));
  menus[id]=new FSMenuNode(id,true,this)
  }
};

var page={
  win:self,
  minW:0,
  minH:0,
  MS:isIE&&!isOp,
  db:document.compatMode&&document.compatMode.indexOf('CSS')>-1?'documentElement':'body'
  };
  
page.elmPos=function(e,p){
  var x=0,y=0,w=p?p:this.win;
  e=e?(e.substr?(isNS4?w.document.anchors[e]:getRef(e,w)):e):p;
  if(isNS4){
    if(e&&(e!=p)){
      x=e.x;
      y=e.y
      };
      
    if(p){
      x+=p.pageX;
      y+=p.pageY
      }
    }
  if(e&&this.MS&&navigator.platform.indexOf('Mac')>-1&&e.tagName=='A'){
  e.onfocus=new Function('with(event){self.tmpX=clientX-offsetX;self.tmpY=clientY-offsetY}');
  e.focus();
  x=tmpX;
  y=tmpY;
  e.blur()
  }else while(e){
  x+=e.offsetLeft;
  y+=e.offsetTop;
  e=e.offsetParent
  }
  return{
  x:x,
  y:y
}
};

if(isNS4){
  var fsmMouseX,fsmMouseY,fsmOR=self.onresize,nsWinW=innerWidth,nsWinH=innerHeight;
  document.fsmMM=document.onmousemove;
  self.onresize=function(){
    if(fsmOR)fsmOR();
    if(nsWinW!=innerWidth||nsWinH!=innerHeight)location.reload()
      };
      
  document.captureEvents(Event.MOUSEMOVE);
  document.onmousemove=function(e){
    fsmMouseX=e.pageX;
    fsmMouseY=e.pageY;
    return document.fsmMM?document.fsmMM(e):document.routeEvent(e)
    };
    
  function isMouseIn(sty){
    with(sty)return((fsmMouseX>left)&&(fsmMouseX<left+clip.width)&&(fsmMouseY>top)&&(fsmMouseY<top+clip.height))
      }
    }

// MENU REPOSITIONING: This will stop menus showing outside visible screen boundaries.
page.winW=function()
{
  with (this) return Math.max(minW, MS?win.document[db].clientWidth:win.innerWidth)
};
page.winH=function()
{
  with (this) return Math.max(minH, MS?win.document[db].clientHeight:win.innerHeight)
};
page.scrollX=function()
{
  with (this) return MS?win.document[db].scrollLeft:win.pageXOffset
};
page.scrollY=function()
{
  with (this) return MS?win.document[db].scrollTop:win.pageYOffset
};

function repositionMenus(mN) {
  var menu = this.menus[mN].lyr;

  // Showing before measuring corrects MSIE bug.
  menu.sty.display = 'block';
  // Reset to and/or store original margins.
  if (!menu._fsm_origML) menu._fsm_origML = menu.ref.currentStyle ?
    menu.ref.currentStyle.marginLeft : (menu.sty.marginLeft || 'auto');
  if (!menu._fsm_origMT) menu._fsm_origMT = menu.ref.currentStyle ?
    menu.ref.currentStyle.marginTop : (menu.sty.marginTop || 'auto');
  menu.sty.marginLeft = menu._fsm_origML;
  menu.sty.marginTop = menu._fsm_origMT;

  // Calculate absolute position within document.
  var menuX = 0, menuY = 0,
  menuW = menu.ref.offsetWidth, menuH = menu.ref.offsetHeight,
  vpL = page.scrollX(), vpR = vpL + page.winW() - 16,
  vpT = page.scrollY(), vpB = vpT + page.winH() - 16;
  var tmp = menu.ref;
  while (tmp)
  {
    menuX += tmp.offsetLeft;
    menuY += tmp.offsetTop;
    tmp = tmp.offsetParent;
  }

  // Compare position to viewport, reposition accordingly.
  var mgL = 0, mgT = 0;

  //IE hack
  if ( navigator.userAgent.toLowerCase().indexOf("msie") != -1 ) menuW += 420;

  if (menuX + menuW > vpR) mgL = vpR - menuX - menuW;
  if (menuX + mgL < vpL) mgL = vpL - menuX;
  if (menuY + menuH > vpB) mgT = vpB - menuY - menuH;
  if (menuY + mgT < vpT) mgT = vpT - menuY;

  mgT += 8;

  if (mgL < 0) menu.sty.marginLeft = '-100px';
  if (mgT) menu.sty.marginTop = mgT + 'px';
 
}



// CURRENT PAGE HIGHLIGHT:
// Note: You will probably have to edit this to make it work. The key line is
// the one that tests location.pathname (which is like '/folder/file.html'
// without any '?querystring' or '#bookmark'). I am trying to find the longest
// matching item and highlight that and all its parent links.
// Note 2: Add a rule like this:
//   .current-page { font-weight: bold }
// or similar to your stylesheet of course :).

function activePageHighlight(elm)
{
  if (typeof elm == 'string') elm = document.getElementById(elm);
  if (!elm) return;
  var links = elm.getElementsByTagName('a'), chosen = null;

  for (var i = 0; i < links.length; i++)
  {
    if (links.item(i).href.indexOf(location.pathname) > -1)
      if (!chosen || links[i].href.length > chosen.href.length) chosen = links[i];
  }

  while (chosen && chosen.className != 'menulist')
  {
    if (chosen.nodeName.toLowerCase() == 'li')
    {
      chosen.getElementsByTagName('a').item(0).className = 'current-page';
    }
    chosen = chosen.parentNode;
  }
};


// LINK FADING: Fades between over/out colours for links in the menu.

FSMenu.prototype.setLinkFading = function(linkClasses, linkSpeed) {
  with (this)

  {
    // Store the link classes in the menu object.
    this.linkClasses = linkClasses || {};
    this.linkSpeed = linkSpeed || 100;
 
    // Find the root menu.
    var mRoot = null;
    for (var m in menus) if (menus[m].isRoot) mRoot = menus[m];
    if (!mRoot) return;

    // Find all link tags and add ID/timers/counters/mouse handlers...
    var links = mRoot.lyr.ref.getElementsByTagName('a'), i = links.length;
    while (i--)
    {
      if (!links[i].id) links[i].id = myName + '-linkfade-' + i;
      links[i].__lf_timer = 0;
      links[i].__lf_count = 0;
      addEvent(links[i], 'mouseover', new Function(myName + '.linkFade("' + links[i].id + '", 1)'));
      addEvent(links[i], 'mouseout', new Function(myName + '.linkFade("' + links[i].id + '", 0)'));
    }
    }
  };

FSMenu.prototype.linkFade = function(link, doShow) {
  with (this)

  {
    // Repeatedly called to animate a link colour in and out.

    link = document.getElementById(link);
    clearTimeout(link.__lf_timer);

    // If we're hiding, delay until the link is no longer highlighted.
    var fadeOK = doShow || !link.className || !cssLitClass ||
    (link.className.indexOf(cssLitClass) == -1);

    if (fadeOK)
    {
      var linkClass = linkClasses[link.className || 'standard'] || linkClasses.standard;
      var dim = linkClass.dim, lit = linkClass.lit;

      // Increment the fading counter in the proper direction and speed.
      link.__lf_count = Math.max(0, Math.min(link.__lf_count+(2*doShow-1)*linkSpeed, 100));
 
      // Since Konqueror as of v3.1 doesn't support Number.toString(radix), we need a hack.
      // What the heck were they thinking/smoking when they omitted that? :P
      var col = '#', nc, hexD = '0123456789ABCDEF';
      // Loop through dim/lit arrays, to calculate 3 new hex pairs (0xRR, 0xGG and 0xBB).
      for (var i=0; i<3; i++)
      {
        // Make a new hex pair based on weighted averages of the out/over array indices.
        nc = parseInt(dim[i] + (lit[i]-dim[i])*(link.__lf_count/100));
        col += hexD.charAt(Math.floor(nc/16)).toString() + hexD.charAt(nc%16);
      }
      // Assign to the background of the link.
      link.style.backgroundColor = col;
    }

    // Repeat in 50ms if we're delaying the fade or the fade isn't done yet.
    if (!fadeOK || (link.__lf_count % 100 > 0)) link.__lf_timer = setTimeout(this.myName +
      '.linkFade("' + link.id + '",' + doShow + ')', 50);
    }
};



function titleDisplay(menuID, target)
{
  var nav = getRef(menuID);
  addEvent(nav, 'mouseover', new Function('e',
    'e=e||window.event; var lt=getRef("' + target + '"); if (lt) {' +
    'while (lt.firstChild) lt.removeChild(lt.firstChild);' +
    'e=e.target||e.srcElement; while(e && (!e.title&&!e.title_orig)) e=e.parentNode;' +
    'if (e && e.getAttribute) {' +
    'var t = e.getAttribute("title");' +
    'if (t) { e.title_orig = t; e.setAttribute("title", "") }' +
    'lt.appendChild(document.createTextNode(e.title_orig));' +
    '}}'));
  addEvent(nav, 'mouseout', new Function('e',
    'var lt=getRef("' + target + '"); if (lt) while (lt.firstChild) lt.removeChild(lt.firstChild)'));
}

