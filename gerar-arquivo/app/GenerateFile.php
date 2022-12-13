<?php
namespace App;

class GenerateFile 
{
    /**
     * Recebe o nome do arquivo
     * @var string
     */

    private string $filename;
    /**
     * Recebe o texto completo para ser inserido no arquivo
     * @var string
     */

    private string $text;

    public function __construct(string $filename, string $text)
    {
        $this->filename = $filename.'.txt';
        $this->text = $text;
    }

    /**
     * Função responsável por gerar o arquivo TXT
     * @return void
     */
    public function generate(): void
    {
        file_put_contents($this->filename, $this->text);
        header('Content-type: octet/stream');
        header('Content-disposition: attachment; filename="' . $this->filename . '";');
        readfile($this->filename);        
    }

    /**
     * Deleta o arquivo. Pode ser usada logo após a geração do mesmo, para que o arquivo não fique salvo no servidor
     * @return void
     */
    public function excludeFile(): void {
        unlink($this->filename);
    }

}