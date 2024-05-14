<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User guide</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    /* Style the button that is used to open and close the collapsible content */
    .collapsible {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    margin-bottom: 5px;
    }

    .active, .collapsible:hover {
    background-color: #d1daff;
    }

    .content {
    padding: 0 18px;
    display: none;
    overflow: hidden;
    background-color: #97cffd8f;
    margin-top: -5px;
    margin-bottom: 5px;

    }
    .carousel-control-prev,.carousel-control-next
    {
        filter: invert(100%);
    }

    .carousel-indicators [data-bs-target]
    {
        background-color: rgb(0, 0, 0);

    }

    .collapsible
    {
      color: #0c63e4;
    background-color: #e7f1ff;
    }



    </style>

</head>

<body class="bg-light">  
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all collapsible buttons
            var coll = document.querySelectorAll('.collapsible');

            // Add click event listener to each button
            coll.forEach(function (item) {
                item.addEventListener('click', function () {
                    // Toggle the content visibility
                    var content = this.nextElementSibling;
                    if (content.style.display === 'block') {
                        content.style.display = 'none';
                    } else {
                        content.style.display = 'block';
                    }
                });
            });
        });
    </script>

<h2 class="text-center">Aged Care User Guide</h2>
<!--Members guide-->
<div>
    <h3>Members guide</h3>
    <button type="button" class="collapsible "><h3>View All members</h3></button>
    <div class="content">
        <div class="container">
            <div id="carouselControls1" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselControls1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselControls1" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div> 
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="images/members_navigate.png" class="d-block w-100" alt="member_navigation">
                  </div>
                  <div class="carousel-item">
                    <img src="images/members_all.png" class="d-block w-100" alt="member_all">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls1" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselControls1" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div>
    </div>

    <button type="button" class="collapsible"><h3>Add new member</h3></button>
    <div class="content">
        <div class="container">
            <div id="carouselControls2" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselControls2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselControls2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>   
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="images/members_new.png" class="d-block w-100" alt="members_new">
                  </div>
                  <div class="carousel-item">
                    <img src="images/members_new_form.png" class="d-block w-100" alt="member_newform">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls2" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselControls2" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div>
    </div>
    
    <button type="button" class="collapsible"><h3>View/Edit a member</h3></button>
    <div class="content">
      <div class="container">
          <div id="carouselControls3" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselControls3" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselControls3" data-bs-slide-to="1" aria-label="Slide 2"></button>
              </div>   
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="images/members_ve.png" class="d-block w-100" alt="members_viewedit">
                </div>
                <div class="carousel-item">
                  <img src="images/members_edit.png" class="d-block w-100" alt="member_edit">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls3" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls3" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>
    </div>
   
<!--Roster guide-->    
<div>
  <h3>Roster guide</h3>
  <button type="button" class="collapsible">View All Roster</button>
  <div class="content">
      <div class="container">
          <div id="carouselControls1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselControls1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselControls1" data-bs-slide-to="1" aria-label="Slide 2"></button>
          </div> 
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="images/members_navigate.png" class="d-block w-100" alt="member_navigation">
                </div>
                <div class="carousel-item">
                  <img src="images/members_all.png" class="d-block w-100" alt="member_all">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls1" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>

  <button type="button" class="collapsible">Add new roster</button>
  <div class="content">
      <div class="container">
          <div id="carouselControls2" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselControls2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselControls2" data-bs-slide-to="1" aria-label="Slide 2"></button>
              </div>   
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="images/members_new.png" class="d-block w-100" alt="members_new">
                </div>
                <div class="carousel-item">
                  <img src="images/members_new_form.png" class="d-block w-100" alt="member_newform">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls2" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>
  
  <button type="button" class="collapsible">View/Edit a roster</button>
  <div class="content">
    <div class="container">
        <div id="carouselControls3" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselControls3" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselControls3" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>   
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="images/members_ve.png" class="d-block w-100" alt="members_viewedit">
              </div>
              <div class="carousel-item">
                <img src="images/members_edit.png" class="d-block w-100" alt="member_edit">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls3" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselControls3" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
</div>
  </div>
<!--
<h3>Roster guide</h3>
<h3>Staff guide</h3>
<h3>Facilites guide</h3>
<h3>Service records</h3> -->

</body>
</html>