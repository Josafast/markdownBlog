<h1 style="margin: 0 auto 30px;">Create your post</h1>
<form action="/create" method="POST">
  <h3>Name: </h3>
  <label for="name">
    <input type="text" name="name" <?php if(isset($_POST['modify'])) {
      echo 'value="'.strtoupper(substr($_POST['name'], 0, 1)) . substr($_POST['name'], 1, strlen($_POST['name'])).'"'; 
    }?>>
  </label>
  <h3>Text: </h3>
  <label for="text">
    <textarea name="text" style="resize: none; height: 200px;"><?php if (isset($_POST['modify'])) { 
      echo $markdownPages->getContent($_POST['name']);
    }?></textarea>
  </label>
  <input type="submit" value="Create" name="write">
</form>