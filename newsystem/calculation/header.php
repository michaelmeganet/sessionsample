<!DOCTYPE html>
<html lang="en" >
    <head>
        <title>PHP CRUD FOR materail</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/style.css">
        <link rel="stylesheet" href="../assets/css/select2.css">
        <script src="../assets/jquery-2.1.1.min.js"></script>
        <script src="../includes/select2/dist/js/select2.full.min.js"></script>

        <script type="text/javascript" >
          $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        </script>
        <script>
            function getSelectOptionPeriod(sel) {
            //alert(sel.options[sel.selectedIndex].text);
                var tmp = sel.options[sel.selectedIndex].text;

                $('#period').val(tmp);
               
                console.log(tmp);
                // alert(tmp." this selected, now proceed to confirm this period.");

            }
        </script>      
            <style>
      form {
        /* Just to center the form on the page */
        margin: 15 ;
        width: 400px;
        /* To see the outline of the form */
        padding: 1em;
        border: 1px solid #CCC;
        border-radius: 1em;
      }

      form div + div {
        margin-top: 1em;
      }

      label {
        /* To make sure that all labels have the same size and are properly aligned */
        display: inline-block;
        width: 90px;
        text-align: right;
      }

      input, textarea {
        /* To make sure that all text fields have the same font settings By default, textareas have a monospace font */
        font: 1em sans-serif;
        /* To give the same size to all text fields */
        width: 300px;
        box-sizing: border-box; /* To harmonize the look & feel of text field border */
        border: 1px solid #999;
      }

      input:focus, textarea:focus {
        /* To give a little highlight on active elements */
        border-color: #000;
      }

      textarea {
        /* To properly align multiline text fields with their labels */
        vertical-align: top;
        /* To give enough room to type some text */
        height: 5em;
      }

      .button {
        /* To position the buttons to the same position of the text fields */
        padding-left: 90px;
        /* same size as the label elements */
      }

      button {
        /* This extra margin represent roughly the same space as the space between the labels and their text fields */
        margin-left: .5em;
      }
    </style>
    </head>
    <body >
        <?php
        if (isset($period) && isset($cid)) {
            include './class/quotation.inc.php';
            $quotation_obj = new Quotation();
        }

        ?>  

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="#"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                          <li> <img src="../assets/images/ce.png" alt="CE" class="tlogo"> </li>
                        <li class="active"><a href="../index.php">Home</a></li>
                    </ul>

                </div>
            </div>
        </nav>