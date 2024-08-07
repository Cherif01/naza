<div id="sidebar" class="active">
  <div class="sidebar-wrapper active">
    <div class="sidebar-header">
      <div class="d-flex justify-content-between">
        <div class="logo">
          <!-- <a href="#"><img src="assets/images/logo/logo.png" alt="Logo" srcset></a> -->
           <h2 class="text-uppercase text-primary fw-bold">NAZA</h2>
        </div>
        <div class="toggler">
          <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
        </div>
      </div>
    </div>
    <div class="sidebar-menu">
      <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item <?= ($page == 'dashboard') ? 'active' : 'no-active' ?>">
          <a href="<?= LINK ?>dashboard" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="sidebar-title">Gestion</li>
        <!-- Agence -->
        <li class="sidebar-item <?= ($page == 'agence') ? 'active' : 'sidebar-item' ?>">
          <a href="<?= LINK ?>agence" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Agence</span>
          </a>
        </li>
        <!-- Users -->
        <li class="sidebar-item <?= ($page == 'users') ? 'active' : 'sidebar-item' ?>">
          <a href="<?= LINK ?>users" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Utilisateurs</span>
          </a>
        </li>

        <li class="sidebar-title">Op&#233;ration</li>
        <!-- send -->
        <li class="sidebar-item <?= ($page == 'send-money') ? 'active' : 'sidebar-item' ?>">
          <a href="<?= LINK ?>send-money" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Transfert d'argent</span>
          </a>
        </li>
        <!-- retrait -->
        <li class="sidebar-item <?= ($page == 'retrait') ? 'active' : 'sidebar-item' ?>">
          <a href="<?= LINK ?>retrait" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>R&#233;trait d'argent</span>
          </a>
        </li>


        <li class="sidebar-title">Rapport</li>

        <!-- Rapport -->
        <li class="sidebar-item <?= ($page == 'rapport') ? 'active' : 'sidebar-item' ?>">
          <a href="<?= LINK ?>rapport" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Rapport</span>
          </a>
        </li>
        <!-- Journal -->
        <li class="sidebar-item <?= ($page == 'journal') ? 'active' : 'sidebar-item' ?>">
          <a href="<?= LINK ?>journal" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Journal</span>
          </a>
        </li>
        <!-- Settings -->
        <li class="sidebar-item <?= ($page == 'settings') ? 'active' : 'sidebar-item' ?>">
          <a href="<?= LINK ?>taux" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Param&#232;tres</span>
          </a>
        </li>

      </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
  </div>
</div>