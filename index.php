<?php
require_once 'config/config.php';

/*
|--------------------------------------------------------------------------
| Homepage Statistics
|--------------------------------------------------------------------------
*/

$totalCitizens = (int)$pdo->query("
SELECT COUNT(*)
FROM users
WHERE role='citizen'
")->fetchColumn();

$totalReports = (int)$pdo->query("
SELECT COUNT(*)
FROM emergency_reports
")->fetchColumn();

$totalResolved = (int)$pdo->query("
SELECT COUNT(*)
FROM emergency_reports
WHERE status='Resolved'
")->fetchColumn();

$totalResponders = (int)$pdo->query("
SELECT COUNT(*)
FROM responders
WHERE availability='Available'
")->fetchColumn();

$stmt = $pdo->prepare("
SELECT
er.report_id,
er.title,
er.priority,
er.created_at,
et.type_name
FROM emergency_reports er
INNER JOIN emergency_types et
ON er.type_id = et.type_id
ORDER BY er.created_at DESC
LIMIT 5
");

$stmt->execute();

$latestReports = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Naija Emergency Report System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">

<style>

body{

background:#f5f5f5;

font-family:Arial,Helvetica,sans-serif;

}

.navbar-brand{

font-weight:bold;

}

.hero{

background:linear-gradient(135deg,#b30000,#ff3b3b);

color:#fff;

padding:120px 0;

}

.hero h1{

font-size:52px;

font-weight:bold;

}

.hero p{

font-size:20px;

margin-top:20px;

}

.section-title{

font-weight:bold;

margin-bottom:40px;

}

.card-hover{

transition:.3s;

}

.card-hover:hover{

transform:translateY(-8px);

box-shadow:0 12px 30px rgba(0,0,0,.15);

}

.counter{

font-size:38px;

font-weight:bold;

color:#dc3545;

}

footer{

background:#212529;

color:#fff;

padding:60px 0;

margin-top:70px;

}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger">

<div class="container">

<a class="navbar-brand" href="index.php">

<i class="fas fa-triangle-exclamation"></i>

Naija Emergency Report

</a>

<button

class="navbar-toggler"

type="button"

data-bs-toggle="collapse"

data-bs-target="#navbarNav">

<span class="navbar-toggler-icon"></span>

</button>

<div

class="collapse navbar-collapse"

id="navbarNav">

<ul class="navbar-nav ms-auto">

<li class="nav-item">

<a class="nav-link active"

href="index.php">

Home

</a>

</li>

<li class="nav-item">

<a class="nav-link"

href="php/login.php">

Login

</a>

</li>

<li class="nav-item">

<a class="nav-link"

href="php/register.php">

Register

</a>

</li>

<li class="nav-item">

<a class="nav-link"

href="#contact">

Contact

</a>

</li>

</ul>

</div>

</div>

</nav>

<section class="hero">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-7">

<h1>

Report Emergencies Instantly

</h1>

<p>

Naija Emergency Report System enables citizens to report crime, road accidents, fire outbreaks, floods, medical emergencies and disasters directly to emergency response agencies.

</p>

<div class="mt-4">

<a href="php/register.php"

class="btn btn-warning btn-lg">

<i class="fas fa-user-plus"></i>

Register

</a>

<a href="php/login.php"

class="btn btn-light btn-lg ms-2">

<i class="fas fa-right-to-bracket"></i>

Login

</a>

</div>

<div class="mt-4">

<h4>

Emergency Hotline

</h4>

<h2>

112

</h2>

</div>

</div>

<div class="col-lg-5 text-center">

<i class="fas fa-triangle-exclamation"

style="font-size:220px;color:#ffffff;"></i>

</div>

</div>

</div>

</section>

<section class="py-5">

<div class="container">

<h2 class="text-center section-title">

Emergency Categories

</h2>

<div class="row g-4">

<div class="col-md-3">

<div class="card card-hover">

<div class="card-body text-center">

<i class="fas fa-fire fa-3x text-danger mb-3"></i>

<h5>Fire Outbreak</h5>

<p>

Report fire emergencies.

</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-hover">

<div class="card-body text-center">

<i class="fas fa-car-burst fa-3x text-primary mb-3"></i>

<h5>Road Accident</h5>

<p>

Quick emergency response.

</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-hover">

<div class="card-body text-center">

<i class="fas fa-user-shield fa-3x text-success mb-3"></i>

<h5>Crime</h5>

<p>

Robbery and violence.

</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-hover">

<div class="card-body text-center">

<i class="fas fa-truck-medical fa-3x text-danger mb-3"></i>

<h5>Medical</h5>

<p>

Medical emergencies.

</p>

</div>

</div>

</div>
        <div class="col-md-3">

            <div class="card card-hover">

                <div class="card-body text-center">

                    <i class="fas fa-water fa-3x text-info mb-3"></i>

                    <h5>Flood</h5>

                    <p>Flood and erosion disasters.</p>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card card-hover">

                <div class="card-body text-center">

                    <i class="fas fa-bolt fa-3x text-warning mb-3"></i>

                    <h5>Electrical Hazard</h5>

                    <p>Power and electrical faults.</p>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card card-hover">

                <div class="card-body text-center">

                    <i class="fas fa-building-circle-exclamation fa-3x text-secondary mb-3"></i>

                    <h5>Building Collapse</h5>

                    <p>Structural collapse emergencies.</p>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card card-hover">

                <div class="card-body text-center">

                    <i class="fas fa-radiation fa-3x text-dark mb-3"></i>

                    <h5>Hazardous Material</h5>

                    <p>Chemical and hazardous incidents.</p>

                </div>

            </div>

        </div>

    </div>

</div>

</section>

<!-- STATISTICS -->

<section class="py-5 bg-light">

<div class="container">

<h2 class="text-center section-title">

System Statistics

</h2>

<div class="row g-4">

<div class="col-md-3">

<div class="card shadow">

<div class="card-body text-center">

<div class="counter">

<?= number_format($totalCitizens) ?>

</div>

<h5>

Registered Citizens

</h5>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow">

<div class="card-body text-center">

<div class="counter">

<?= number_format($totalReports) ?>

</div>

<h5>

Emergency Reports

</h5>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow">

<div class="card-body text-center">

<div class="counter">

<?= number_format($totalResponders) ?>

</div>

<h5>

Available Responders

</h5>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow">

<div class="card-body text-center">

<div class="counter">

<?= number_format($totalResolved) ?>

</div>

<h5>

Resolved Cases

</h5>

</div>

</div>

</div>

</div>

</div>

</section>

<!-- HOW IT WORKS -->

<section class="py-5">

<div class="container">

<h2 class="text-center section-title">

How It Works

</h2>

<div class="row g-4">

<div class="col-md-3">

<div class="card shadow h-100">

<div class="card-body text-center">

<i class="fas fa-mobile-screen-button fa-3x text-primary mb-3"></i>

<h5>

1. Submit Report

</h5>

<p>

Citizen reports an emergency with location and evidence.

</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow h-100">

<div class="card-body text-center">

<i class="fas fa-user-check fa-3x text-success mb-3"></i>

<h5>

2. Verification

</h5>

<p>

Administrator verifies the emergency report.

</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow h-100">

<div class="card-body text-center">

<i class="fas fa-truck fa-3x text-danger mb-3"></i>

<h5>

3. Dispatch

</h5>

<p>

Emergency responder is assigned immediately.

</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow h-100">

<div class="card-body text-center">

<i class="fas fa-circle-check fa-3x text-success mb-3"></i>

<h5>

4. Resolution

</h5>

<p>

Responder resolves the incident and updates the report.

</p>

</div>

</div>

</div>

</div>

</div>

</section>

<!-- LATEST REPORTS -->

<section class="py-5 bg-light">

<div class="container">

<h2 class="text-center section-title">

Latest Emergency Reports

</h2>

<div class="table-responsive">

<table class="table table-striped table-hover">

<thead class="table-danger">

<tr>

<th>#</th>

<th>Emergency Type</th>

<th>Title</th>

<th>Priority</th>

<th>Date</th>

</tr>

</thead>

<tbody>

<?php if(!empty($latestReports)): ?>

<?php foreach($latestReports as $report): ?>

<tr>

<td><?= $report['report_id']; ?></td>

<td><?= htmlspecialchars($report['type_name']); ?></td>

<td><?= htmlspecialchars($report['title']); ?></td>

<td>

<span class="badge bg-danger">

<?= htmlspecialchars($report['priority']); ?>

</span>

</td>

<td>

<?= date('d M Y H:i', strtotime($report['created_at'])); ?>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="5" class="text-center">

No emergency reports available.

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</section>
<!-- EMERGENCY AGENCIES -->

<section class="py-5">

<div class="container">

<h2 class="text-center section-title">

Emergency Response Agencies

</h2>

<div class="row text-center g-4">

<div class="col-md-2">

<div class="card shadow h-100">

<div class="card-body">

<i class="fas fa-shield-halved fa-3x text-primary mb-3"></i>

<h6>Nigeria Police Force</h6>

</div>

</div>

</div>

<div class="col-md-2">

<div class="card shadow h-100">

<div class="card-body">

<i class="fas fa-fire-extinguisher fa-3x text-danger mb-3"></i>

<h6>Fire Service</h6>

</div>

</div>

</div>

<div class="col-md-2">

<div class="card shadow h-100">

<div class="card-body">

<i class="fas fa-road fa-3x text-warning mb-3"></i>

<h6>FRSC</h6>

</div>

</div>

</div>

<div class="col-md-2">

<div class="card shadow h-100">

<div class="card-body">

<i class="fas fa-truck-medical fa-3x text-success mb-3"></i>

<h6>Ambulance</h6>

</div>

</div>

</div>

<div class="col-md-2">

<div class="card shadow h-100">

<div class="card-body">

<i class="fas fa-house-tsunami fa-3x text-info mb-3"></i>

<h6>NEMA</h6>

</div>

</div>

</div>

<div class="col-md-2">

<div class="card shadow h-100">

<div class="card-body">

<i class="fas fa-user-shield fa-3x text-secondary mb-3"></i>

<h6>NSCDC</h6>

</div>

</div>

</div>

</div>

</div>

</section>

<!-- CONTACT -->

<section class="py-5 bg-dark text-white" id="contact">

<div class="container">

<div class="row">

<div class="col-lg-6">

<h2 class="mb-4">

Contact Information

</h2>

<p>

Naija Emergency Report System provides a centralized platform for citizens to report emergencies and receive timely response from relevant emergency agencies.

</p>

<p>

<i class="fas fa-phone text-warning"></i>

<strong> Emergency Number:</strong> 112

</p>

<p>

<i class="fas fa-envelope text-warning"></i>

support@naijaemergencyreport.ng

</p>

<p>

<i class="fas fa-location-dot text-warning"></i>

Abuja, Federal Capital Territory, Nigeria

</p>

</div>

<div class="col-lg-6">

<div class="card">

<div class="card-body">

<h4 class="mb-3 text-dark">

Emergency Hotlines

</h4>

<table class="table table-bordered">

<tr>

<th>Agency</th>

<th>Hotline</th>

</tr>

<tr>

<td>National Emergency</td>

<td><strong>112</strong></td>

</tr>

<tr>

<td>Police</td>

<td><strong>112</strong></td>

</tr>

<tr>

<td>FRSC</td>

<td><strong>122</strong></td>

</tr>

<tr>

<td>Fire Service</td>

<td>State Emergency Line</td>

</tr>

<tr>

<td>Ambulance</td>

<td>State Emergency Line</td>

</tr>

</table>

</div>

</div>

</div>

</div>

</div>

</section>

<!-- FOOTER -->

<footer>

<div class="container">

<div class="row">

<div class="col-md-4">

<h5>

Naija Emergency Report System

</h5>

<p>

A web-based emergency reporting and response management platform built with PHP, MySQL, JavaScript and Bootstrap.

</p>

</div>

<div class="col-md-4">

<h5>

Quick Links

</h5>

<ul class="list-unstyled">

<li>

<a href="index.php" class="text-white text-decoration-none">

Home

</a>

</li>

<li>

<a href="php/login.php" class="text-white text-decoration-none">

Login

</a>

</li>

<li>

<a href="php/register.php" class="text-white text-decoration-none">

Register

</a>

</li>

<li>

<a href="#contact" class="text-white text-decoration-none">

Contact

</a>

</li>

</ul>

</div>

<div class="col-md-4">

<h5>

Technology Stack

</h5>

<ul class="list-unstyled">

<li>PHP 8+</li>

<li>MySQL</li>

<li>Bootstrap 5</li>

<li>JavaScript</li>

<li>HTML5 & CSS3</li>

</ul>

</div>

</div>

<hr>

<div class="text-center">

<p class="mb-0">

&copy; <?= date('Y'); ?>

Naija Emergency Report System.

All Rights Reserved.

</p>

</div>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

window.addEventListener('scroll',function(){

const navbar=document.querySelector('.navbar');

if(window.scrollY>50){

navbar.classList.add('shadow');

}else{

navbar.classList.remove('shadow');

}

});

document.querySelectorAll('a[href^="#"]').forEach(function(anchor){

anchor.addEventListener('click',function(e){

e.preventDefault();

const target=document.querySelector(this.getAttribute('href'));

if(target){

target.scrollIntoView({

behavior:'smooth'

});

}

});

});

</script>

</body>

</html>