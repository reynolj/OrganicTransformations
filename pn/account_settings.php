<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Home"; //Set the browser title
$highlight = "index"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML
?>

<head>
  <script type="text/javascript">
    <!-- Put Javascript Here -->
  </script>

  <script src="AdminLTE/plugins/moment/moment.min.js"></script>
  <script src="AdminLTE/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

  <style>
    ul {
      margin: 15px;
      padding: 0px;
    }
  </style>
</head>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Account Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Account Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div> <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">


          <div class="row">
            <div class="col-md-6">
              <div class="card card-primary card-outline"> <!--card-secondary for grey format-->
                  <div class="card-header">
                    <h3 class="card-title">Edit Profile</h3>
                  </div> <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="first_name last_name">Name</label>
                        <input type="text" class="form-control" id="first_name" placeholder="First Name">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="last_name" placeholder="Last Name">
                      </div>

                      <div class="form-group">
                        <label for="email_address">Email address</label>
                        <input type="email" class="form-control" id="email_address" placeholder="Enter Email">
                      </div>

                      <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" im-insert="true" placeholder="(___) ___-____">
                      </div>

                      <div class="form-group">
                        <label>Gender</label>
                        <select class="custom-select" id="gender">
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Date of Birth</label></br>
                          <div class="row">
                            <div class="col-md-4">
                                <select class="custom-select" id="birth-month">
                                    <option value="January">January</option>
                                    <option value="Febuary">Febuary</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div> <!-- /.col-md-4 month -->

                            <div class="col-md-4">
                                <select class="custom-select" id="birth-day">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                    <option>13</option>
                                    <option>14</option>
                                    <option>15</option>
                                    <option>16</option>
                                    <option>17</option>
                                    <option>18</option>
                                    <option>19</option>
                                    <option>20</option>
                                    <option>21</option>
                                    <option>22</option>
                                    <option>23</option>
                                    <option>24</option>
                                    <option>25</option>
                                    <option>26</option>
                                    <option>27</option>
                                    <option>28</option>
                                    <option>29</option>
                                    <option>30</option>
                                    <option>31</option>
                                </select>
                            </div> <!-- /.col-md-4 day -->

                            <div class="col-md-4">
                                <select class="custom-select" id="birth-year">
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                    <option value="2010">2010</option>
                                    <option value="2009">2009</option>
                                    <option value="2008">2008</option>
                                    <option value="2007">2007</option>
                                    <option value="2006">2006</option>
                                    <option value="2005">2005</option>
                                    <option value="2004">2004</option>
                                    <option value="2003">2003</option>
                                    <option value="2002">2002</option>
                                    <option value="2001">2001</option>
                                    <option value="2000">2000</option>
                                    <option value="1999">1999</option>
                                    <option value="1998">1998</option>
                                    <option value="1997">1997</option>
                                    <option value="1996">1996</option>
                                    <option value="1995">1995</option>
                                    <option value="1994">1994</option>
                                    <option value="1993">1993</option>
                                    <option value="1992">1992</option>
                                    <option value="1991">1991</option>
                                    <option value="1990">1990</option>
                                    <option value="1989">1989</option>
                                    <option value="1988">1988</option>
                                    <option value="1987">1987</option>
                                    <option value="1986">1986</option>
                                    <option value="1985">1985</option>
                                    <option value="1984">1984</option>
                                    <option value="1983">1983</option>
                                    <option value="1982">1982</option>
                                    <option value="1981">1981</option>
                                    <option value="1980">1980</option>
                                    <option value="1979">1979</option>
                                    <option value="1978">1978</option>
                                    <option value="1977">1977</option>
                                    <option value="1976">1976</option>
                                    <option value="1975">1975</option>
                                    <option value="1974">1974</option>
                                    <option value="1973">1973</option>
                                    <option value="1972">1972</option>
                                    <option value="1971">1971</option>
                                    <option value="1970">1970</option>
                                    <option value="1969">1969</option>
                                    <option value="1968">1968</option>
                                    <option value="1967">1967</option>
                                    <option value="1966">1966</option>
                                    <option value="1965">1965</option>
                                    <option value="1964">1964</option>
                                    <option value="1963">1963</option>
                                    <option value="1962">1962</option>
                                    <option value="1961">1961</option>
                                    <option value="1960">1960</option>
                                    <option value="1959">1959</option>
                                    <option value="1958">1958</option>
                                    <option value="1957">1957</option>
                                    <option value="1956">1956</option>
                                    <option value="1955">1955</option>
                                    <option value="1954">1954</option>
                                    <option value="1953">1953</option>
                                    <option value="1952">1952</option>
                                    <option value="1951">1951</option>
                                    <option value="1950">1950</option>
                                    <option value="1949">1949</option>
                                    <option value="1948">1948</option>
                                    <option value="1947">1947</option>
                                    <option value="1946">1946</option>
                                    <option value="1945">1945</option>
                                    <option value="1944">1944</option>
                                    <option value="1943">1943</option>
                                    <option value="1942">1942</option>
                                    <option value="1941">1941</option>
                                    <option value="1940">1940</option>
                                    <option value="1939">1939</option>
                                    <option value="1938">1938</option>
                                    <option value="1937">1937</option>
                                    <option value="1936">1936</option>
                                    <option value="1935">1935</option>
                                    <option value="1934">1934</option>
                                    <option value="1933">1933</option>
                                    <option value="1932">1932</option>
                                    <option value="1931">1931</option>
                                    <option value="1930">1930</option>
                                </select>
                            </div> <!-- /.col-md-4 year -->
                          </div> <!-- /.row -->
                      </div> <!-- /.form-group -->
                    </div> <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div> <!-- /.card-footer -->
                  </form>
              </div> <!-- /.card-primary -->
            </div> <!-- /.col-md-6 -->

            <div class="col-md-6">
              <div class="card card-primary card-outline"> <!--card-secondary for grey format-->
                  <div class="card-header">
                    <h3 class="card-title">Change Password</h3>
                  </div> <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="new_password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Old Password">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" id="new_password" placeholder="New Password">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" id="new_password" placeholder="Confirm New Password">
                      </div>
                    </div> <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div> <!-- /.card-footer -->
                  </form>
              </div> <!-- /.card-primary -->

              <div class="card card-primary card-outline"> <!--card-secondary for grey format-->
                  <div class="card-header">
                    <h3 class="card-title">Delete Account</h3>
                  </div> <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form">
                    <div class="card-body">
                        <p>We have to verify your request to delete your account by sending an email to you. After clicking "Delete Account," please check your email and click the link provided.</p>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Delete Account</button>
                    </div> <!-- /.card-footer -->
                  </form>
              </div> <!-- /.card-primary -->
            </div> <!-- /.col-md-6 -->
          </div> <!-- /.row -->

          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-0">My Plan</h5>
            </div> <!-- /.card-header -->
            <div class="card-body">
              <!-- Place page content here -->
			  <p>Note: Upgrades will take effect immediately, stopping any future recurring payments under the previous plan. Meanwhile, downgrades will take effect at the end of the billing cycle. Payments cannot be refunded.</p>
              <hr noshade></hr noshade>
              <p>If you would like to cancel your current plan, please <a href="#">click here</a> to confirm with email.</p>
              <div class="row">
                <div class="col-md-2">
                    <div class="card card-primary">
                      <div class="card-body">
                        <!-- Place page content here -->
                        <button type="button" class="btn btn-block bg-gradient-info">Free!</button>
                        </br><center><h5><b>$0/month</b></h5></center>
                        <hr noshade></hr noshade>
                        <ul>
                            <li>Access to our free content</li>
                            <li>Free muscle training videos</li>
                            <li>Free nutritional training videos</li>
                            <li>Free guides</li>
                        </ul>
                      </div> <!-- /.card-body -->
                    </div> <!-- /.card-primary -->
                </div> <!-- /.col -->
                <div class="col-md-2">
                    <div class="card card-primary">
                      <div class="card-body">
                        <!-- Place page content here -->
                        <button type="button" class="btn btn-block bg-gradient-info">Beginner</button>
                        </br><center><h5><b>$4/month</b></h5></center>
                        <hr noshade></hr noshade>
                        <ul>
                            <li><b><i>Free</i></b> plan +</li>
                            <li>Beginner muscle training videos</li>
                            <li>Beginner nutritional training videos</li>
                            <li>Beginner level guides</li>
                        </ul>
                      </div> <!-- /.card-body -->
                    </div> <!-- /.card-primary -->
                </div> <!-- /.col -->
                <div class="col-md-2">
                    <div class="card card-primary">
                      <div class="card-body">
                        <!-- Place page content here -->
                        <button type="button" class="btn btn-block bg-gradient-info">Intermediate</button>
                        </br><center><h5><b>$8/month</b></h5></center>
                        <hr noshade></hr noshade>
                        <ul>
                            <li><b><i>Beginner</i></b> plan +</li>
                            <li>Intermediate muscle training videos</li>
                            <li>Intermediate nutritional training videos</li>
                            <li>Intermediate level guides</li>
                        </ul>
                      </div> <!-- /.card-body -->
                    </div> <!-- /.card-primary -->
                </div> <!-- /.col -->
                <div class="col-md-2">
                    <div class="card card-primary">
                      <div class="card-body">
                        <!-- Place page content here -->
                        <button type="button" class="btn btn-block bg-gradient-info">Advanced</button>
                        </br><center><h5><b>$12/month</b></h5></center>
                        <hr noshade></hr noshade>
                        <ul>
                            <li><b><i>Intermediate</i></b> plan +</li>
                            <li>Advanced muscle training videos</li>
                            <li>Advanced nutritional training videos</li>
                            <li>Advanced level guides</li>
                        </ul>
                      </div> <!-- /.card-body -->
                    </div> <!-- /.card-primary -->
                </div> <!-- /.col -->
                <div class="col-md-2">
                    <div class="card card-primary">
                      <div class="card-body">
                        <!-- Place page content here -->
                        <button type="button" class="btn btn-block bg-gradient-info">Personal</button>
                        </br><center><h5><b>$15/month</b></h5></center>
                        <hr noshade></hr noshade>
                        <ul>
                            <li><b><i>Advanced</i></b> plan +</li>
                            <li>Access to premium content</li>
                            <li>Monthly private coaching with trainers!</li>
                        </ul>
                      </div> <!-- /.card-body -->
                    </div> <!-- /.card-primary -->
                </div> <!-- /.col -->
              </div> <!-- /.row -->
            </div> <!-- /.card-body -->
          </div> <!-- /.card-primary -->

      </div> <!-- /.container-fluid -->
    </div> <!-- /.content -->
  </div> <!-- /.content-wrapper -->

<?php include('structure/bottom.php'); ?>