<?php

  include(__DIR__.'/../php/parsedown.php');
  class MarkdownPages {
    protected $markdownDIR = __DIR__.'/../markdown/';

    public function writeFile(string $name, string $text):void{
      $file = fopen($this->markdownDIR.strtolower(str_replace(" ", "_", $name)).'.md', 'w');
      fwrite($file, $text);
      fclose($file);
    }

    public function deleteFile(string $name): void{
      $deleteDIR = $this->markdownDIR .= $name.'.md'; 
      if(file_exists($deleteDIR)){
        unlink($deleteDIR);
      }
    }

    public function getParsed(string $view): string{
      if (($viewData = $this->getContent($view)) != 'NotFounded') $viewData = $this->parse($viewData);
      return $viewData;
    }

    public function getContent(string $fileName): string{
      $fileName = $this->markdownDIR.$fileName.'.md';
      if (file_exists($fileName)) return file_get_contents($fileName);
      return 'NotFounded';
    }

    public function parse(string $fileContent): string{
      $markdownParser = new Parsedown();
      return $markdownParser->text($fileContent);
    }

    public function getPages(): array{
      $filesDIR = opendir($this->markdownDIR);
      $mdFilesList = array();

      while ($file = readdir($filesDIR)) {
        $file = str_replace("_", " ", $file);
          if (str_ends_with($file, '.md') AND (!str_contains($file, 'how-to-use') and !str_contains($file, 'contact'))){
            $mdFilesList[substr($file, 0, strlen($file)-3)] = strtoupper(substr($file, 0, 1)) . substr($file, 1, strlen($file)-4); 
          }
      }

      return $mdFilesList;
    }
  }

  $markdownPages = new MarkdownPages();

?>
