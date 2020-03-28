<?php
require("api/auth/login_check.php"); //Make sure the users is logged in
$title = "OT | Guides"; //Set the browser title
$highlight = "guides"; //Select which tab in the navigation to highlight
require("structure/top.php"); //Include the sidebar HTML


?>
    <html>
    <head>
        <script type="module">
            import Guide from "./api/guides/Guide.js";

            $(document).ready(function() {
                //Perform search on search click
                $('#search-submit').on('click', function(){
                    var search = $('#search-input').val();  //Gettingsearch  from search input
                    perform_search(search); //Performing search
                    $('#results-title').html('Results for "' +  search + '"') //Renaming title of results card
                });
                //Get all guides (search)
                perform_search();
            });

            function perform_search(search_terms){
                    $.ajax({
                        type: "POST",
                        data: {
                            search_terms: search_terms
                        },
                        url: './api/guides/get_guides_term_search.php',
                        success: function (data) {
                            const searchResults = JSON.parse(data);
                            let guide;
                            console.log(searchResults)
                            $('#search-results').html('');
                            for(let key in searchResults) {
                                if(searchResults.hasOwnProperty(key)) {
                                    //Creating a new guide object
                                    guide = new Guide(searchResults[key]);
                                    $('#search-results').append(guide.card);
                                }
                            }
                        },
                        error: function () {
                            console.log('Error Retrieving search results')
                        }

                    });
                }
        </script>
    </head>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Guides</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="guides.php">Guides</a></li>
                            <li class="breadcrumb-item active">Guides</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <!-- Body -->
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Search</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <input id="search-input" class="form-control" type="text" placeholder="Search for...">
                            </div>
                            <div class="col-3">
                                <button id="search-submit" class="form-control btn btn-primary">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </div>

        <!-- /.content -->
        <div class="content">
            <div class="container-fluid">

                <!-- Body -->
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title" id="results-title">Results</h3>
                    </div>
                    <div class="card-body">
                        <div class="row" id="search-results">

                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </div>
    </div>
    <!-- /.content-wrapper -->
    </html>
<?php include('structure/bottom.php'); ?>