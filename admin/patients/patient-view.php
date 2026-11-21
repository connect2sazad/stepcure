<?php

$address_states_options = getAddressStatesOptions();
?>

<div class="nav-align-top mb-4" id="patient-details">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-patient-details" aria-controls="navs-patient-details" aria-selected="true">
                Patient Details
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-consultations" aria-controls="navs-consultations" aria-selected="false">
                Consultations
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-sales" aria-controls="navs-sales" aria-selected="false">
                Sales
            </button>
        </li>
        <!-- <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-feedbacks" aria-controls="navs-feedbacks" aria-selected="false">
                Feedbacks
            </button>
        </li> -->
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="navs-patient-details" role="tabpanel">

            <?php
            include_once './patient-view-details.php';
            ?>

        </div>
        <div class="tab-pane fade" id="navs-consultations" role="tabpanel">

            <?php
            include_once './patient-view-consultations.php';
            ?>

        </div>
        <div class="tab-pane fade" id="navs-sales" role="tabpanel">
            <?php
            include_once './patient-view-sales.php';
            ?>
        </div>
        <div class="tab-pane fade" id="navs-feedbacks" role="tabpanel">
            <p>
                Feedbacks
            </p>
        </div>
    </div>
</div>