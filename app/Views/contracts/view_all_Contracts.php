<?php include dirname(__DIR__, 2) . "/views/layouts/header.php";



?>

<body>
    <?php include dirname(__DIR__, 2) . "/views/layouts/navigation-admin.php"; ?>
    <div class="content content-fixed bd-b">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-5">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Contracts</a></li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0">View All</h4>
                </div>
                <div class="mg-t-20 mg-sm-t-0">
<!--
                    <a href="#modal6" data-bs-toggle="modal" data-animation="effect-slide-in-bottom">
                        <button type="button" class="btn btn-primary btn-icon">
                            <i data-feather="user-plus"></i>
                        </button>

                    </a>

-->
                </div>
            </div>
            <div class="content">
                <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="available-contracts-tab" data-bs-toggle="tab"
                            data-bs-target="#available-contracts" type="button" role="tab"
                            aria-controls="available-contracts" aria-selected="true">Available Contracts</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="processing-tab" data-bs-toggle="tab" data-bs-target="#processing"
                            type="button" role="tab" aria-controls="processing"
                            aria-selected="false">Processing</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed"
                            type="button" role="tab" aria-controls="completed" aria-selected="false">Departured</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="deported-tab" data-bs-toggle="tab" data-bs-target="#deported"
                            type="button" role="tab" aria-controls="deported" aria-selected="false">Deported</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="available-contracts" role="tabpanel"
                        aria-labelledby="available-contracts-tab">

                        <?php include('contract-parts/available_contracts.php'); ?>

                    </div>
                    <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processing-tab">

                    <?php include('contract-parts/processing_contracts.php'); ?>

                    </div>
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        <p>Content for Completed tab.</p>
                    </div>
                    <div class="tab-pane fade" id="deported" role="tabpanel" aria-labelledby="deported-tab">
                        <p>Content for Deported tab.</p>
                    </div>
                </div>
            </div>
        </div>
        <!--Popup form for Precheck Registration -->
        
        <!-- End popup -->



        <?php include dirname(__DIR__, 2) . "/views/layouts/footer.php";  ?>


</body>

</html>