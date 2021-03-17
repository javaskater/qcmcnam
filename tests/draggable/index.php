<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css" >
    <style>
        .list-group .list-group-item.start{
            background: #eaf2fe;
        }
    
        .list-group .list-group-item.over{
            background: #d5d5d5;
        }
    </style>

    <title>Bonjour</title>
  </head>
  <body>
  <div class="container-fluid">
  	<ul class="list-group">
  		<li class="list-group-item" draggable="true"><span id="q1">première question</span></li>
  		<li class="list-group-item" draggable="true"><span id="q2">seconde question</span></li>
  		<li class="list-group-item" draggable="true"><span id="q3">troisième question</span></li>
  		<li class="list-group-item" draggable="true"><span id="q4">quatrième question</span></li>
  	</ul>
  	<button type="submit" class="btn btn-primary">Submit</button>
  </div>
<?php
?>
<script type="text/javascript">
	var dragElem = null
	var cols = document.querySelectorAll('.list-group .list-group-item');
    var colsLength = cols.length;
    var button = document.querySelector('.btn.btn-primary');
    function dragStartHandler(e) {
            //Set data
            dragElem = this;
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/html', this.innerHTML);
            this.classList.add('over');
            for (var i = 0; i < colsLength; i++) {
                cols[i].classList.add('start');
            };
        };
        function dragOverHandler(e) {
            e.preventDefault();
            this.classList.add('over');
            e.dataTransfer.dropEffect = 'move';
        };

        function dragLeaveHandler(e) {
            this.classList.remove('over');
        };

        function dragDropHandler(e) {
            e.preventDefault();
            //Get data
            dragElem.innerHTML = this.innerHTML;
            this.innerHTML = e.dataTransfer.getData('text/html');
            for (var i = 0; i < colsLength; i++) {
                cols[i].className = "list-group-item";
            };
        };
        function dragDropHandler(e) {
            e.preventDefault();
            //Get data
            dragElem.innerHTML = this.innerHTML;
            this.innerHTML = e.dataTransfer.getData('text/html');
            for (var i = 0; i < colsLength; i++) {
                cols[i].className = "list-group-item";
            };
        };
        function listerQuestions(e){
        	var result = "";
            var elts = document.querySelectorAll('.list-group .list-group-item span');
            for (var i = 0; i < elts.length; i++){
            	var elt = elts[i];
            	result += "-"+ elt.id;
            }
            console.log(result);
        };
        for (var i = 0; i < colsLength; i++) {
            cols[i].addEventListener('dragstart', dragStartHandler, false);
            cols[i].addEventListener('dragover', dragOverHandler, false);
            cols[i].addEventListener('dragleave', dragLeaveHandler, false);
            cols[i].addEventListener('drop', dragDropHandler, false);
        };
        button.addEventListener('click', listerQuestions, false);
        
    
</script>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../js/jquery/jquery-3.6.0.js"></script>
    <script src="../../js/bootstrap/bootstrap.js"></script>
  </body>
</html>