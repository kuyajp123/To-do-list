<style>
    .new {
        height: 20%;
    }

    .links {
        height: 80%;
        padding: 20px;
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
        <a href="#" class="sidebar-link">
            <li class="list-group-item border-0">
                <button class="btn w-100 text-dark d-flex justify-content-between align-items-start fw-bold">Dashboard</button>
            </li>
        </a>

        <a href="#" class="sidebar-link">
            <li class="list-group-item border-0">
                <button class="btn w-100 text-dark d-flex justify-content-between align-items-start fw-bold">Tasks</button>
            </li>
        </a>
        <a href="#" class="sidebar-link">
            <li class="list-group-item border-0">
                <button class="btn w-100 text-dark d-flex justify-content-between align-items-start fw-bold">Notes</button>
            </li>
        </a>
        <a href="#" class="sidebar-link">
            <li class="list-group-item border-0">
                <button class="btn w-100 text-dark d-flex justify-content-between align-items-start fw-bold">Schedules</button>
            </li>
        </a>
    </ul>
</div>