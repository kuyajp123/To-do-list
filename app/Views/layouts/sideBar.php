<style>
    .new {
        height: 20%;
    }

    .links {
        height: 80%;
        padding: 20px;
    }

    .list-group-item {
        background-color: #F8F8FF;
    }

    .sidebar-link .btn:hover,
    .sidebar-link:hover .btn {
        background-color: rgb(233, 233, 233);
        color: rgb(107, 107, 107);
        transition: background 0.2s, color 0.2s;
    }

    a {
        text-decoration: none;
    }

    #sidebarbtn {
        display: none;
    }

    /* Hide sidebar on small screens */
    @media (max-width: 725px) {
        .body {
            grid-template-columns: 1fr;
        }

        .links {
            display: none;
        }

        #sidebarbtn {
            display: block !important;
        }
    }
</style>

<div style="background-color: #F8F8FF;" class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
        <img src="<?= base_url('assets/brand/logo.png') ?>" alt="MG Logo" width="50" class="rounded-circle">
        <span class="fw-bold fs-5 ms-2">To-Do List</span>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <ul class="list-group ">
        <a href="<?= base_url('dashboard') ?>" class="sidebar-link">
            <li class="list-group-item border-0 rounded">
                <button class="btn w-100 text-dark d-flex gap-3 align-items-start fw-bold">
                    <i class="bi bi-bar-chart-line-fill text-secondary"></i>Dashboard</button>
            </li>
        </a>

        <a href="<?= base_url('tasks') ?>" class="sidebar-link">
            <li class="list-group-item border-0">
                <button class="btn w-100 text-dark d-flex gap-3 align-items-start fw-bold">
                    <i class="bi bi-clipboard2-check-fill text-secondary"></i>Tasks</button>
            </li>
        </a>
        <a href="<?= base_url('schedule') ?>" class="sidebar-link">
            <li class="list-group-item border-0">
                <button class="btn w-100 text-dark d-flex gap-3 align-items-start fw-bold"> <i class="bi bi-calendar-check-fill text-secondary"></i>Schedules</button>
            </li>
        </a>
    </ul>
</div>

<div class="links">
    <ul class="list-group ">
        <a href="<?= base_url('dashboard') ?>" class="sidebar-link">
            <li class="list-group-item border-0 rounded">
                <button class="btn w-100 text-dark d-flex gap-3 align-items-start fw-bold">
                    <i class="bi bi-bar-chart-line-fill text-secondary"></i>Dashboard</button>
            </li>
        </a>

        <a href="<?= base_url('tasks') ?>" class="sidebar-link">
            <li class="list-group-item border-0">
                <button class="btn w-100 text-dark d-flex gap-3 align-items-start fw-bold">
                    <i class="bi bi-clipboard2-check-fill text-secondary"></i>Tasks</button>
            </li>
        </a>
        <a href="<?= base_url('schedule') ?>" class="sidebar-link">
            <li class="list-group-item border-0">
                <button class="btn w-100 text-dark d-flex gap-3 align-items-start fw-bold"> <i class="bi bi-calendar-check-fill text-secondary"></i>Schedules</button>
            </li>
        </a>
    </ul>
</div>