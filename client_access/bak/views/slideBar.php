<style>
  .sidebar-menu a:hover{
    text-decoration: initial !important;
    color: white !important;
  }  
</style>

<div class="main-header-left d-none d-lg-block">
  <div class="logo-wrapper"><a href="home_users.php"><!--<img src="assets/images/unibrica.png" alt="">--></a></div>
</div>

<div class="sidebar custom-scrollbar">
  
  <div class="sidebar-user text-center">
    <div><img class="img-60 rounded-circle" src="assets/images/dashboard/user.png" alt="#">
      <!--<div class="profile-edit"><a href="edit-profile.html" target="_blank"><i data-feather="edit"></i></a></div>-->
    </div>
    <h6 class="mt-3 f-14"><?php 
      if ($_SESSION['rowUsers']['tipo']==2) {
        echo $_SESSION['rowUsers']['usuario']; 
        $tipoUser= $_SESSION['rowUsers']['tipo'];
      }else{
        echo $_SESSION['rowUsers']['email']; 
        $tipoUser = $_SESSION['rowUsers']['tipo'];
      }?>
    </h6>
    <p><?php //echo $tipoUser; ?></p>
  </div>
  
  <ul class="sidebar-menu"><?php
    $script_name=explode("/",$_SERVER["SCRIPT_NAME"]);
    $script_name=$script_name[count($script_name)-1];
  
    if ($_SESSION['rowUsers']['tipo'] == 1) {?>
      <li><a class="sidebar-header" href="empresas.php"><i data-feather="plus"></i><span>Empresas</span><i class="fa fa-angle-right pull-right"></i></a>
        <!-- <ul class="sidebar-submenu">
          <li><a class="sidebar-header" href="#"><i data-feather="plus"></i><span>Altas</span><i class="fa fa-angle-right pull-right"></i></a>
            <ul class="sidebar-submenu">
              <li><a class="sidebar-header" href="#"><i data-feather="plus"></i><span>Empresas</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                  <li><a href="empresas.php"><i class="fa fa-circle"></i> ABM Empresas</a></li>
                  <li><a href="#"><i class="fa fa-circle"></i> Perfiles</a></li>
                  <li><a href="#"><i class="fa fa-circle"></i> Empleados</a></li>
                  <li><a href="#"><i class="fa fa-circle"></i> Jerarquias</a></li>
                </ul>
              </li>
            </ul>
            <ul class="sidebar-submenu">
              <li><a class="sidebar-header" href="#"><i data-feather="plus"></i><span>Clientes</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                  <li><a href="#"><i class="fa fa-circle"></i> Contactos</a></li>
                  <li><a href="#"><i class="fa fa-circle"></i> Locaciones</a></li>
                  <li><a href="#"><i class="fa fa-circle"></i> Condiciones</a></li>
                </ul>
              </li>
            </ul>
            <ul class="sidebar-submenu">
              <li><a class="sidebar-header" href="#"><i data-feather="plus"></i><span>Usuarios</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                  <li><a href="usuarios.php"><i class="fa fa-circle"></i> Perfiles</a></li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="sidebar-submenu">
          <li><a class="sidebar-header" href="#"><i data-feather="plus"></i><span>Parámetros</span><i class="fa fa-angle-right pull-right"></i></a>
            <ul class="sidebar-submenu">
              <li><a href="unidades.php"><i class="fa fa-circle"></i> Unidades</a></li>
              <li><a href="rubros.php"><i class="fa fa-circle"></i> Rubros</a></li>
              <li><a href="subrubros.php"><i class="fa fa-circle"></i> Subrubros</a></li>
              <li><a href="#"><i class="fa fa-circle"></i> Puestos</a></li>
              <li><a href="categorias_items.php"><i class="fa fa-circle"></i> Categorias</a></li>
              <li><a href="tipos_items.php"><i class="fa fa-circle"></i> Tipos de productos</a></li>
              <li><a href="sindicatos.php"><i class="fa fa-circle"></i> Sindicatos</a></li>
              <li><a href="cargos.php"><i class="fa fa-circle"></i> Cargos</a></li>
            </ul>
          </li>
        </ul> -->
      </li>

      <!-- <li><a class="sidebar-header" href="#"><i data-feather="plus"></i><span>Maestro</span><i class="fa fa-angle-right pull-right"></i></a>
        <ul class="sidebar-submenu">
          <li>
            <a class="sidebar-header" href="#"><i data-feather="plus"></i><span>Usuarios ABM</span><i class="fa fa-angle-right pull-right"></i></a>
              <ul class="sidebar-submenu">
                <li>
                  <a class="sidebar-header" href="#"><i data-feather="plus"></i><span>Accesos WEB</span><i class="fa fa-angle-right pull-right mt-2"></i></a>
                  <ul class="sidebar-submenu">
                    <li><a href="#"><i class="fa fa-circle"></i> Dashboard General</a></li>
                    <li><a href="accesos_web.php"><i class="fa fa-circle"></i> Gestor tks</a></li>
                  </ul>
                </li>
                <li>
                  <a class="sidebar-header" href="#"><i data-feather="plus"></i><span>Accesos APP</span><i class="fa fa-angle-right pull-right mt-2"></i></a>
                </li>
              </ul>
          </li>
        </ul>
      </li> -->
      <?php
    } else if ($_SESSION['rowUsers']['tipo'] == 2){

      
    }?>
  </ul>
</div>
<script type='text/javascript'>
  //PARA "OCULTAR" LAS OPCIONES DEL MENÚ QUE AÚN NO SE USAN
  document.querySelectorAll('.sidebar-menu a').forEach((anchor) => {
      if(anchor.classList.length==0){
        //console.log(anchor);
        if(anchor.getAttribute("href")=="#"){
          anchor.style.textDecoration="line-through";
          anchor.style.color="black";
        }
      }
  });

  document.addEventListener("DOMContentLoaded", function(event) {
    //let anchor=document.querySelector("a[href='<?=$script_name?>']")
    let script_name=window.location.href.split("/")
    script_name=script_name[script_name.length-1]
    script_name=script_name.split("?")
    script_name=script_name[0].replace("#", '');
    console.log(script_name);
    let anchor=document.querySelector("a[href='"+script_name+"']")
    let el=anchor.parentElement;
    el.style.border="solid 1px white";
    el.style.borderRadius="20px";
    el.style.paddingLeft="10px";
    el.style.backgroundColor="rgb(255 255 255 / 10%)";
    console.log(el.classList);
    while(!el.classList.contains('sidebar-menu')){
      if(el.nodeName=="LI"){
        el.classList.add('active')
      }
      if(el.nodeName=="UL" && el.classList.contains('sidebar-submenu')){
        el.classList.add('menu-open')
      }
      el=el.parentElement;
    }
  });
</script>