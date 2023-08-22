<h1 style="margin: 0 auto 30px;">List of Posts</h1>

<ul class="posts-list">
<?php foreach($markdownPages->getPages() as $markdownFileName => $markdownFileParsedName): ?>
  <li>
    <a href="/?view=<?php echo $markdownFileName;?>">
      <?php echo $markdownFileParsedName;?>
    </a>
  </li>
<?php endforeach;?>
</ul>