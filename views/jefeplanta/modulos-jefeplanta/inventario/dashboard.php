<?php
// dashboard.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Boardto Dashboard</title>
  <link rel="stylesheet" href="/sistema-produccion/public/css/style_inventario.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <div class="logo">
        <i class="fas fa-chart-line"></i>
        <span>Boardto</span>
      </div>
      <button class="toggle-btn" id="toggleSidebar">
        <i class="fas fa-bars"></i>
      </button>
    </div>

    <nav class="sidebar-nav">
      <ul>
        <li><a href="#"><i class="fas fa-th-large"></i> Boards</a></li>
        <li><a href="#"><i class="far fa-calendar-alt"></i> Plan Schedule</a></li>
        <li class="active"><a href="#"><i class="far fa-file-alt"></i> Reporting</a></li>
        <li><a href="#"><i class="far fa-comment"></i> Messages</a></li>
        <li><a href="#"><i class="fas fa-users"></i> Team Member</a></li>
        <li><a href="#"><i class="fas fa-cogs"></i> Tools Plugin</a></li>
        <li><a href="#"><i class="fas fa-road"></i> Roadmap</a></li>
        <li><a href="#"><i class="fas fa-cog"></i> Setting</a></li>
        <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="main-content" id="mainContent">
    <!-- Header -->
    <header class="header">
      <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search..." />
      </div>
      <div class="header-right">
        <div class="notification">
          <i class="far fa-bell"></i>
          <span class="badge">1</span>
        </div>
        <div class="user-profile">
          <img src="https://via.placeholder.com/40" alt="User" />
          <div class="user-info">
            <span>Augusta Ryan</span>
            <small>Director</small>
          </div>
          <i class="fas fa-chevron-down"></i>
        </div>
      </div>
    </header>

    <!-- Dashboard Content -->
    <section class="dashboard">
      <div class="section-header">
        <h2>Reporting</h2>
        <p>All project in current month</p>
      </div>

      <div class="filters">
        <button class="filter-btn active">All <span>50</span></button>
        <button class="filter-btn">Started <span>20</span></button>
        <button class="filter-btn">Approval <span>15</span></button>
        <button class="filter-btn">Completed <span>34</span></button>
      </div>

      <div class="actions">
        <button class="btn-add"><i class="fas fa-plus"></i></button>
        <div class="view-options">
          <button><i class="fas fa-list"></i></button>
          <button><i class="fas fa-th-large"></i></button>
          <button><i class="fas fa-ellipsis-v"></i></button>
        </div>
      </div>

      <!-- Projects Grid -->
      <div class="projects-grid">
        <!-- Project Card 1 -->
        <div class="project-card">
          <div class="card-icon" style="background: #FF6B9D;">
            <i class="fas fa-mobile-alt"></i>
          </div>
          <h3>App Development</h3>
          <div class="team-info"><i class="fas fa-users"></i> Marketing Team</div>
          <div class="time-left"><i class="far fa-clock"></i> 1 Weeks Left</div>
          <div class="progress-info">
            <div class="avatars">
              <img src="https://via.placeholder.com/24" alt="User" />
              <img src="https://via.placeholder.com/24" alt="User" />
              <img src="https://via.placeholder.com/24" alt="User" />
            </div>
            <div class="progress"><span>Team Member</span><span>Progress</span></div>
            <div class="progress-bar">
              <div class="fill" style="width: 34%;"></div><span>34%</span>
            </div>
          </div>
        </div>

        <!-- Project Card 2 -->
        <div class="project-card">
          <div class="card-icon" style="background: #2EC4B6;">
            <i class="fas fa-laptop-code"></i>
          </div>
          <h3>Web Design</h3>
          <div class="team-info"><i class="fas fa-users"></i> Core UI Team</div>
          <div class="time-left"><i class="far fa-clock"></i> 3 Weeks Left</div>
          <div class="progress-info">
            <div class="avatars">
              <img src="https://via.placeholder.com/24" alt="User" />
              <span>+</span>
            </div>
            <div class="progress"><span>Team Member</span><span>Progress</span></div>
            <div class="progress-bar">
              <div class="fill" style="width: 76%;"></div><span>76%</span>
            </div>
          </div>
        </div>

        <!-- Project Card 3 -->
        <div class="project-card">
          <div class="card-icon" style="background: #4A90E2;">
            <i class="fas fa-globe"></i>
          </div>
          <h3>Landing Page</h3>
          <div class="team-info"><i class="fas fa-users"></i> Marketing Team</div>
          <div class="time-left"><i class="far fa-clock"></i> 2 Days Left</div>
          <div class="progress-info">
            <div class="avatars">
              <img src="https://via.placeholder.com/24" alt="User" />
              <img src="https://via.placeholder.com/24" alt="User" />
              <span>+</span>
            </div>
            <div class="progress"><span>Team Member</span><span>Progress</span></div>
            <div class="progress-bar">
              <div class="fill" style="width: 4%;"></div><span>4%</span>
            </div>
          </div>
        </div>

        <!-- Project Card 4 -->
        <div class="project-card">
          <div class="card-icon" style="background: #FF9F1C;">
            <i class="fas fa-chart-pie"></i>
          </div>
          <h3>Business Compare</h3>
          <div class="team-info"><i class="fas fa-users"></i> Marketing Team</div>
          <div class="time-left"><i class="far fa-clock"></i> 1 Month Left</div>
          <div class="progress-info">
            <div class="avatars">
              <img src="https://via.placeholder.com/24" alt="User" />
              <img src="https://via.placeholder.com/24" alt="User" />
              <span>+</span>
            </div>
            <div class="progress"><span>Team Member</span><span>Progress</span></div>
            <div class="progress-bar">
              <div class="fill" style="width: 90%;"></div><span>90%</span>
            </div>
          </div>
        </div>

        <!-- Project Card 5 -->
        <div class="project-card">
          <div class="card-icon" style="background: #9B5DE5;">
            <i class="fas fa-shopping-cart"></i>
          </div>
          <h3>Commerce Checkout</h3>
          <div class="team-info"><i class="fas fa-users"></i> Order Process Team</div>
          <div class="time-left"><i class="far fa-clock"></i> 3 Weeks Left</div>
          <div class="progress-info">
            <div class="avatars"><img src="https://via.placeholder.com/24" alt="User" /><span>+</span></div>
            <div class="progress"><span>Team Member</span><span>Progress</span></div>
            <div class="progress-bar"><div class="fill" style="width: 65%;"></div><span>65%</span></div>
          </div>
        </div>

        <!-- Project Card 6 -->
        <div class="project-card">
          <div class="card-icon" style="background: #FF9F1C;">
            <i class="fas fa-database"></i>
          </div>
          <h3>Data Staging</h3>
          <div class="team-info"><i class="fas fa-users"></i> Core Data Team</div>
          <div class="time-left"><i class="far fa-clock"></i> 2 Month Left</div>
          <div class="progress-info">
            <div class="avatars">
              <img src="https://via.placeholder.com/24" alt="User" />
              <img src="https://via.placeholder.com/24" alt="User" />
              <span>+</span>
            </div>
            <div class="progress"><span>Team Member</span><span>Progress</span></div>
            <div class="progress-bar"><div class="fill" style="width: 96%;"></div><span>96%</span></div>
          </div>
        </div>

        <!-- Project Card 7 -->
        <div class="project-card">
          <div class="card-icon" style="background: #4A90E2;">
            <i class="fas fa-video"></i>
          </div>
          <h3>Campaign Store</h3>
          <div class="team-info"><i class="fas fa-users"></i> Internal Communication</div>
          <div class="time-left"><i class="far fa-clock"></i> 11 Days Left</div>
          <div class="progress-info">
            <div class="avatars">
              <img src="https://via.placeholder.com/24" alt="User" />
              <img src="https://via.placeholder.com/24" alt="User" />
              <img src="https://via.placeholder.com/24" alt="User" />
              <span>+</span>
            </div>
            <div class="progress"><span>Team Member</span><span>Progress</span></div>
            <div class="progress-bar"><div class="fill" style="width: 24%;"></div><span>24%</span></div>
          </div>
        </div>

        <!-- Project Card 8 -->
        <div class="project-card">
          <div class="card-icon" style="background: #FF6B9D;">
            <i class="fas fa-user-tie"></i>
          </div>
          <h3>Acquisition Mitra</h3>
          <div class="team-info"><i class="fas fa-users"></i> Merchant team</div>
          <div class="time-left"><i class="far fa-clock"></i> 1 Weeks Left</div>
          <div class="progress-info">
            <div class="avatars"><img src="https://via.placeholder.com/24" alt="User" /><span>+</span></div>
            <div class="progress"><span>Team Member</span><span>Progress</span></div>
            <div class="progress-bar"><div class="fill" style="width: 70%;"></div><span>70%</span></div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script src="/sistema-produccion/public/js/script_inventario.js"></script>
</body>
</html>
