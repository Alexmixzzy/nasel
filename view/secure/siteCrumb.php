
<!-- Page header start -->
<div class="page-header">
						
    <!-- Breadcrumb start -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Welcome, <?php $model->voidUser('fullname'); ?>  
        <?php // echo $obj->model->authUser; ?></li>
    </ol>
    <!-- Breadcrumb end -->

    <!-- App actions start -->
    <div class="app-actions">
        <button type="button" class="btn">Today</button>
        <button type="button" class="btn">Yesterday</button>
        <button type="button" class="btn">7 days</button>
        <button type="button" class="btn">15 days</button>
        <button type="button" class="btn active">30 days</button>
    </div>
    <!-- App actions end -->

</div>
<!-- Page header end -->