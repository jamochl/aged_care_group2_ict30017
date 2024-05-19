<?php include '../config.php'; ?>
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

<!--Staff guide-->    
<div>
  <h3>Staff guide</h3>
  <button type="button" class="collapsible "><h3>View all staff</h3></button>
  <div class="content">
      <div class="container">
          <div id="carouselControls2.1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselControls2.1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselControls2.1" data-bs-slide-to="1" aria-label="Slide 2"></button>
          </div> 
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/staff_menu.png" class="d-block w-100" alt="staff_menu">
                </div>
                <div class="carousel-item">
                  <img src="/images/staff_all.png" class="d-block w-100" alt="staff_all">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls2.1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls2.1" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>

  <button type="button" class="collapsible"><h3>Add new staff</h3></button>
  <div class="content">
      <div class="container">
          <div id="carouselControls2.2" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselControls2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselControls2" data-bs-slide-to="1" aria-label="Slide 2"></button>
              </div>   
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/staff_add.png" class="d-block w-100" alt="staff_add">
                </div>
                <div class="carousel-item">
                  <img src="/images/staff_add_form.png" class="d-block w-100" alt="staff_add_form">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls2.2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls2.2" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>
  
  <button type="button" class="collapsible"><h3>View/Edit a staff</h3></button>
  <div class="content">
    <div class="container">
        <div id="carouselControls2.3" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselControls3" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselControls3" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>   
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="/images/staff_edit.png" class="d-block w-100" alt="staff_edit">
              </div>
              <div class="carousel-item">
                <img src="/images/staff_edit_form.png" class="d-block w-100" alt="staff_edit_form">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls2.3" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselControls2.3" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
</div>

</div>

<!--Members guide-->
<div>
    <h3>Members guide</h3>
    <button type="button" class="collapsible "><h3>View all members</h3></button>
    <div class="content">
        <div class="container">
            <div id="carouselControls1.1" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselControls1.1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselControls1.1" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div> 
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="/images/member_menu.png" class="d-block w-100" alt="member_menu">
                  </div>
                  <div class="carousel-item">
                    <img src="/images/member_all.png" class="d-block w-100" alt="member_all">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls1.1" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselControls1.1" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div>
    </div>

    <button type="button" class="collapsible"><h3>Add new member</h3></button>
    <div class="content">
        <div class="container">
            <div id="carouselControls1.2" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselControls1.2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselControls1.2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>   
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="/images/member_add.png" class="d-block w-100" alt="members_add">
                  </div>
                  <div class="carousel-item">
                    <img src="/images/member_add_form.png" class="d-block w-100" alt="member_add_form">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls1.2" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselControls1.2" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div>
    </div>
    
    <button type="button" class="collapsible"><h3>View/Edit a member</h3></button>
    <div class="content">
      <div class="container">
          <div id="carouselControls1.3" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselControls1.3" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselControls1.3" data-bs-slide-to="1" aria-label="Slide 2"></button>
              </div>   
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/member_edit.png" class="d-block w-100" alt="members_edit">
                </div>
                <div class="carousel-item">
                  <img src="/images/member_edit_form.png" class="d-block w-100" alt="member_edit_form">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls1.3" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls1.3" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>

  <button type="button" class="collapsible"><h3>View service history</h3></button>
  <div class="content">
    <div class="container">
        <div id="carouselControls1.4" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselControls1.4" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselControls1.4" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>   
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="/images/member_history.png" class="d-block w-100" alt="member_history">
              </div>
              <div class="carousel-item">
                <img src="/images/members_history_view.png" class="d-block w-100" alt="member_history_view">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls1.4" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselControls1.4" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
</div>
    </div>
   
<!--roster and availability guide-->    
<div>
  <h3>Roster & availability guide</h3>
  <button type="button" class="collapsible "><h3>View all rosters and availabilities</h3></button>
  <div class="content">
      <div class="container">
          <div id="carouselControls5.1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselControls5.1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselControls5.1" data-bs-slide-to="1" aria-label="Slide 2"></button>
          </div> 
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/roster_menu.png" class="d-block w-100" alt="roster_menu">
                </div>
                <div class="carousel-item">
                  <img src="/images/roster_view.png" class="d-block w-100" alt="roster_view">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls5.1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls5.1" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>

  <button type="button" class="collapsible"><h3>Add new roster</h3></button>
  <div class="content">
      <div class="container">
          <div id="carouselControls5.2" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselControls5.2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselControls5.2" data-bs-slide-to="1" aria-label="Slide 2"></button>
              </div>   
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/roster_add.png" class="d-block w-100" alt="roster_add">
                </div>
                <div class="carousel-item">
                  <img src="/images/roster_add_form.png" class="d-block w-100" alt="roster_add_form">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls5.2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls5.2" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>

  <button type="button" class="collapsible"><h3>view past rosters and availabilities</h3></button>
  <div class="content">
      <div class="container">
          <div id="carouselControls5.3" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselControls5.3" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselControls5.3" data-bs-slide-to="1" aria-label="Slide 2"></button>
              </div>   
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/roster_past.png" class="d-block w-100" alt="roster_past">
                </div>
                <div class="carousel-item">
                  <img src="/images/roster_past_view.png" class="d-block w-100" alt="roster_past_view">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls5.3" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls5.3" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>  
  </div>  

<!--Inventory guide-->    
<div>
  <h3>Inventory guide</h3>
  <button type="button" class="collapsible "><h3>View inventory</h3></button>
  <div class="content">
      <div class="container">
          <div id="carouselControls3.1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselControls2.1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselControls2.1" data-bs-slide-to="1" aria-label="Slide 2"></button>
          </div> 
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/inventory_menu.png" class="d-block w-100" alt="inventory_menu">
                </div>
                <div class="carousel-item">
                  <img src="/images/inventory_all.png" class="d-block w-100" alt="inventory_all">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls3.1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls3.1" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>

  <button type="button" class="collapsible"><h3>Add new item</h3></button>
  <div class="content">
      <div class="container">
          <div id="carouselControls2" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselControls2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselControls2" data-bs-slide-to="1" aria-label="Slide 2"></button>
              </div>   
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/inventory_add.png" class="d-block w-100" alt="inventory_add">
                </div>
                <div class="carousel-item">
                  <img src="/images/inventory_add_form.png" class="d-block w-100" alt="inventory_add_form">
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
  
  </div>

<!--Billing guide-->    
<div>
  <h3>Billing guide</h3>
  <button type="button" class="collapsible "><h3>View all billings</h3></button>
  <div class="content">
      <div class="container">
          <div id="carouselControls4.1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselControls4.1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselControls4.1" data-bs-slide-to="1" aria-label="Slide 2"></button>
          </div> 
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/billing_menu.png" class="d-block w-100" alt="billing_menu">
                </div>
                <div class="carousel-item">
                  <img src="/images/billing_all.png" class="d-block w-100" alt="billing_all">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls4.1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls4.1" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>

  <button type="button" class="collapsible"><h3>Generate billing report</h3></button>
  <div class="content">
      <div class="container">
          <div id="carouselControls4.2" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselControls4.2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselControls4.2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselControls4.2" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>   
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/billing_generate.png" class="d-block w-100" alt="billing_generate">
                </div>
                <div class="carousel-item">
                  <img src="/images/billing_generate_link.png" class="d-block w-100" alt="billing_generate_link">
                </div>
                <div class="carousel-item">
                  <img src="/images/billing_generate_view.png" class="d-block w-100" alt="billing_generate_view">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls4.2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls4.2" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>
  </div>  

<!--Service record guide-->    
<div>
  <h3>Service record guide</h3>
  <button type="button" class="collapsible "><h3>View all service records</h3></button>
  <div class="content">
      <div class="container">
          <div id="carouselControls6.1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselControls4.1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselControls4.1" data-bs-slide-to="1" aria-label="Slide 2"></button>
          </div> 
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/srecord_menu.png" class="d-block w-100" alt="srecord_menu">
                </div>
                <div class="carousel-item">
                  <img src="/images/srecords_view.png" class="d-block w-100" alt="srecords_view">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls6.1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls6.1" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>

  <button type="button" class="collapsible"><h3>Add new service record</h3></button>
  <div class="content">
      <div class="container">
          <div id="carouselControls6.2" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselControls4.2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselControls4.2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselControls4.2" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>   
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/srecords_add.png" class="d-block w-100" alt="srecords_add">
                </div>
                <div class="carousel-item">
                  <img src="/images/srecord_add_form.png" class="d-block w-100" alt="srecord_add_form">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls6.2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls6.2" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>
  </div>  
  
  <!--others guide-->    
<div>
  <h3>Others</h3>
  <button type="button" class="collapsible "><h3>View all rooms</h3></button>
  <div class="content">
      <div class="container">
          <div id="carouselControls7.1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselControls4.1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselControls4.1" data-bs-slide-to="1" aria-label="Slide 2"></button>
          </div> 
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/rooms_menu.png" class="d-block w-100" alt="rooms_menu">
                </div>
                <div class="carousel-item">
                  <img src="/images/rooms_view.png" class="d-block w-100" alt="rooms_view">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls7.1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls7.1" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>

  <button type="button" class="collapsible"><h3>Add new room</h3></button>
  <div class="content">
      <div class="container">
          <div id="carouselControls7.2" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselControls4.2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselControls4.2" data-bs-slide-to="1" aria-label="Slide 2"></button>
              </div>   
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/rooms_add.png" class="d-block w-100" alt="rooms_add">
                </div>
                <div class="carousel-item">
                  <img src="/images/rooms_add_form.png" class="d-block w-100" alt="rooms_add_form">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls7.2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls7.2" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>
  
  <button type="button" class="collapsible"><h3>View cleaning status</h3></button>
  <div class="content">
      <div class="container">
          <div id="carouselControls7.3" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselControls4.2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselControls4.2" data-bs-slide-to="1" aria-label="Slide 2"></button>
              </div>   
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/cleaning_menu.png" class="d-block w-100" alt="cleaning_menu">
                </div>
                <div class="carousel-item">
                  <img src="/images/cleanining_view.png" class="d-block w-100" alt="cleanining_view">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls7.3" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselControls7.3" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
      </div>
  </div>
  </div>  

</body>
</html>