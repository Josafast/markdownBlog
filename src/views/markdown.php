   <ul class="markdown-options">
    <li>
      <form action="/delete" method="POST">
        <label for="name">
          <input type="hidden" name="name" value="<?php echo strtolower(str_replace(" ", "_", $_GET['view']))?>">
        </label>
        <input type="submit" value="Delete">
      </form>
    </li>
    <li>
    <form action="/modify" method="POST">
        <label for="name">
          <input type="hidden" name="name" value="<?php echo strtolower(str_replace(" ", "_", $_GET['view']))?>">
        </label>
        <input type="submit" value="Modify" name="modify">
      </form>
    </li>
  </ul>
  <hr style="margin: 20px 0;">
  
    <?php 
      $content = $markdownPages->getParsed(strtolower(str_replace(" ", "_", $_GET['view'])));
      if ($content != 'NotFounded'){
        echo $content != 'NotFounded' ? "<markdown-style>".$content."</markdown-style>" : '<h1>Post not founded</h1>';
      }  
    ?>
