<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>404 - Bootstrap Admin Template</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
	    
	<link href="/phone/resources/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="/phone/resources/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.css" integrity="sha512-mNBK16eobgxYTbRSQhlXA6hEVqfO+o31KEctFCjcn1FytkihWQGCAB4ktjdt/NiGE6q6b09aosY0det7YQa8AA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="/phone/resources/css/font-awesome.css" rel="stylesheet">
	    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
	    
	<link href="/phone/resources/css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>
	
	<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="index.html">
				Bootstrap Admin Template				
			</a>		
			
			<div class="nav-collapse">
				<ul class="nav pull-right">
					
					<li class="">						
						<a href="index.html" class="">
							<i class="icon-chevron-left"></i>
							Back to Dashboard
						</a>
						
					</li>
				</ul>
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->



<div class="container">
	
	<div class="row">
		
		<div class="span12">
			
			<div class="error-container">
				<h1>404</h1>
				
				<h2>This ID doesn't exist</h2>
				
				<div class="error-details">Sorry, This ID doesn't exist! Why not try going back to the <a href="{{ route('homead') }}">home page</a> or perhaps try following!
					
				</div> <!-- /error-details -->
				
				<div class="error-actions">
					<a href="{{ route('homead') }}" class="btn btn-large btn-primary">
						<i class="icon-chevron-left"></i>
						&nbsp;
						Back to Dashboard						
					</a>
					
					
					
				</div> <!-- /error-actions -->
							
			</div> <!-- /error-container -->			
			
		</div> <!-- /span12 -->
		
	</div> <!-- /row -->
	
</div> <!-- /container -->


<script src="/phone/resources/css/js/jquery-1.7.2.min.js"></script>
<script src="/phone/resources/css/js/bootstrap.js"></script>

</body>

</html>
