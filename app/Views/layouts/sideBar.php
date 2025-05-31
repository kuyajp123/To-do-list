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
</style>

<div class="new d-flex justify-content-center align-items-center">
    <button style="border: 2px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" class="btn text-dark fs-6 px-5 py-3 fw-bold" onclick="window.location.href='<?= base_url('user/new') ?>'">
        <i class="bi bi-plus fw-bold"></i>
        New</button>
</div>
<div class="links">
    <ul class="list-group ">
        <a href="<?= base_url('dashboard') ?>" class="sidebar-link">
            <li class="list-group-item border-0">
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
        <a href="#" class="sidebar-link">
            <li class="list-group-item border-0">
                <button class="btn w-100 text-dark d-flex gap-3 align-items-start fw-bold">
                    <i class="bi bi-file-earmark-text-fill text-secondary"></i>Notes</button>
            </li>
        </a>
        <a href="#" class="sidebar-link">
            <li class="list-group-item border-0">
                <button class="btn w-100 text-dark d-flex gap-3 align-items-start fw-bold"> <i class="bi bi-calendar-check-fill text-secondary"></i>Schedules</button>
            </li>
        </a>
    </ul>
</div>