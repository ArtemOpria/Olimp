
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
</div><!-- /#right-panel -->
<!-- Right Panel -->


<script src="../vendors/jquery/dist/jquery.min.js"></script>
<script src="../vendors/popper.js/dist/umd/popper.min.js"></script>

<script src="../vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="../vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>

<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../assets/js/main.js"></script>

<script type="text/javascript">
    setInterval(function () {
        timer();
    }, 1000);

    function timer() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (xmlhttp.responseText == "00:00:01") {
                    window.location = "result.php";
                }
                document.getElementById("countdowntimer").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "../forajax/load_timer.php", true);
        xmlhttp.send(null);
    }
</script>

</body>
</html>