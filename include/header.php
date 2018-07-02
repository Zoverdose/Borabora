<header> 
  <div> 
    <div>                 	
      <h1 class="text-3a"><a href="/borabora/">Le BORA<span>-BORA</span></a></h1> 
      <nav>  
        <ul class="menu">
          <li<?php echo $_SERVER['SCRIPT_NAME'] == '/index.php' ? ' class="current"' : '' ?>>
            <a href="/borabora/">Accueil</a>
          </li>
          <li<?php echo $_SERVER['SCRIPT_NAME'] == '/a-propos.php' ? ' class="current"' : '' ?>>
            <a href="/borabora/a-propos.php">A propos</a>
          </li>
          <li<?php echo $_SERVER['SCRIPT_NAME'] == '/nos-prestations.php' ? ' class="current"' : '' ?>>
            <a href="/borabora/nos-prestations.php">Nos prestations</a>
          </li>
          <li<?php echo $_SERVER['SCRIPT_NAME'] == '/nos-tarifs.php' ? ' class="current"' : '' ?>>
            <a href="/borabora/nos-tarifs.php">Nos tarifs</a>
          </li>
          <li<?php echo $_SERVER['SCRIPT_NAME'] == '/products.php' ? ' class="current"' : '' ?>>
            <a href="#">Calendrier</a>
          </li>
          <li<?php echo $_SERVER['SCRIPT_NAME'] == '/contacts.php' ? ' class="current"' : '' ?>>
            <a href="/borabora/contacts.php">Contacts</a>
              <li<?php echo $_SERVER['SCRIPT_NAME'] == '/coemplo.php' ? ' class="current"' : '' ?>>
              <?php session_start();
if (isset($_SESSION['login']))
{
  ?> <a href="deco.php">Deconnexion</a><?php
  
}
else {
  ?> <a href="/borabora/coemplo.php">Connection</a> <?php
}
?>
          </li>
        </ul>
      </nav>
      <div class="clear"></div>
    </div>
  </div>
</header>
