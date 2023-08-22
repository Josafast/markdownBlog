<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/styles/styles.css">
   <script src="https://unpkg.com/@wcj/markdown-style"></script>
  <script src="https://cdn.skypack.dev/@wcj/markdown-style"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
         
  <title>Welcome</title>
</head>
<body>
  <header>
    <a href="/" class="go-home">
      <h1>Home</h1>
    </a>
    <nav>
			<ul class="pages-list">
				<span class="close-menu">
								<ion-icon name="close"></ion-icon>
				</span>
        <li>
          <a href="/create">Create</a>
        </li>
        <li>
          <a href="/how-to-use">How to use</a>
        </li>
        <li>
          <a href="/contact">Contact Me</a>
        </li>
      </ul>
      <span class="menu">
	<ion-icon name="menu"></ion-icon>
      </span>
		</nav>
    <script>
				let menuButton = document.querySelector('.menu');
				let closeMenuButton = document.querySelector('.close-menu');
				let menu = document.querySelector('.pages-list');

				menuButton.addEventListener('click', ()=>{
								menu.classList.add('active');
				});

				closeMenuButton.addEventListener('click', ()=>{
								menu.classList.remove('active');
				});
    </script>
  </header>
  <main>
    <?php
    
      $viewsDIR = __DIR__."/views"; 
      require_once('controllers/markdownController.php');

      if (isset($_GET['view'])){
        require $viewsDIR.'/markdown.php';
      } else {
        switch ($_SERVER['REQUEST_URI']){
          case '/':
            require __DIR__.'/../public/welcome.php';
            break;
          case '/delete':
            if (isset($_POST['name'])){
              $markdownPages->deleteFile($_POST['name']);
              echo '<script>location.replace("/")</script>';
            }
            break;
          case '/create':
            if (isset($_POST['write'])){
              $markdownPages->writeFile($_POST['name'], $_POST['text']);
              echo '<script>location.replace("/")</script>';
            }
            require $viewsDIR.'/create.php';
	    break;
	  case ('how-to-use' or 'contact-me'):
	    echo "<markdown-style>".
		$markdownPages->getParsed($_SERVER['REQUEST_URI']).
		"</markdown-style>";
	    break;
          case '/modify':
            if (!isset($_POST['modify'])) $_SERVER['REQUEST_URI'] = '/create';
            require $viewsDIR.'/create.php';
	    break;
	  default:
          if ($page = file_exists($viewsDIR.$_SERVER['REQUEST_URI'].'.php')){
            exit(require $page);
          }

          require $viewsDIR.'/not_found.php';
        }
      }

    ?>
  </main>
</body>
</html>
