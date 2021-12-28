<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppBase extends Command
{

    protected $signature = 'app:base';
    protected $description = 'Classe base';


    public function handle()
    {
        // 
    }

    public function classEdit($class) {
        return new class($class) {
            public $name = false;
            public $file = false;
            public $lineStart = false;
            public $lineFinal = false;

            public function __construct($class) {
                if (is_string($class)) {
                    if ($realpath = realpath($class)) {
        
                        $classname = str_replace(base_path(), '', $realpath);
                        $classname = str_replace('\app', '\App', $classname);
                        $classname = preg_replace('/\..+?$/', '', $classname);
                        
                        $this->name = $classname;
                    }
                    else {
                        $this->name = $class;
                    }
                }

                if ($this->name) {
                    $r = new \ReflectionClass($this->name);
                    $this->file = $r->getFileName();
                    $this->lineStart = $r->getStartLine()-1;
                    $this->lineFinal = $r->getEndLine();
                }
            }

            public function getSource($lineStart=null, $lineFinal=null) {
                if ($this->file) {
                    $lineStart = $lineStart===null? $this->lineStart: $lineStart;
                    $lineFinal = $lineFinal===null? $this->lineFinal: $lineFinal;

                    $lines = [];
                    foreach(file($this->file) as $line => $content) {
                        if ($line < $lineStart) continue;
                        if ($line > $lineFinal) continue;
                        $lines[] = $content;
                    }
                    return implode("\n", $lines);
                }

                return '';
            }

            public function methodWrite($methodName, $methodContent, $overwrite=false) {
                $r = new \ReflectionClass($this->name);
                $classSource = file_get_contents($this->file);

                if (is_array($methodContent)) {
                    $methodContent = implode("\n", $methodContent);
                }

                if ($r->hasMethod($methodName)) {
                    if (!$overwrite) return false;
                    $m = $r->getMethod($methodName);
                    $lineStart = $m->getStartLine()-1;
                    $lineFinal = $m->getEndLine()-1;
                    $lines = file($this->file);
                    array_splice($lines, $lineStart, $lineFinal-$lineStart+1, "{$methodContent}\n");
                    $classSource = implode('', $lines);
                }

                else {
                    $classSource = rtrim(rtrim($classSource), '}') ."\n". $methodContent ."\n\n}";
                }
                
                file_put_contents($this->file, $classSource, true);
            }
        };
    }


    public function getFieldSchema($field) {
        $field = (array) $field;
        $schema = [ $field['Type'] ];
        $schema[] = (($field['Null']=='NO' || $field['Key']=='PRI')? 'NOT NULL': 'NULL');
        if ($field['Extra']=='auto_increment') $schema[] = 'AUTO_INCREMENT';
        if ($field['Key'] != 'PRI' AND !str_contains($field['Type'], 'varchar') AND !str_contains($field['Type'], 'int') AND $field['Type']!='longtext' AND $field['Type']!='timestamp') {
            $schema[] = ($field['Default']===NULL? 'DEFAULT NULL': "DEFAULT '{$field['Default']}'");
        }
        return implode(' ', $schema);
    }


    public function varExport($data) {
        $dump = var_export($data, true);
        $dump = preg_replace('#(?:\A|\n)([ ]*)array \(#i', '[', $dump); // Starts
        $dump = preg_replace('#\n([ ]*)\),#', "\n$1],", $dump); // Ends
        $dump = preg_replace('#=> \[\n\s+\],\n#', "=> [],\n", $dump); // Empties
        if (gettype($data) == 'object') { // Deal with object states
            $dump = str_replace('__set_state(array(', '__set_state([', $dump);
            $dump = preg_replace('#\)\)$#', "])", $dump);
        }
        else {  $dump = preg_replace('#\)$#', "]", $dump); }
        return $dump;
    }

    public function classSource($class) {
        if (is_string($class)) {
            $class = app($this->Model->Namespace);
        }

        $class = new \ReflectionClass($class);
        $fileName = $class->getFileName();
        $startLine = $class->getStartLine()-1;
        $endLine = $class->getEndLine();
        $numLines = $endLine - $startLine;
        $fileContents = null;

        if(!empty($fileName)) {
            $fileContents = file_get_contents($fileName);
            $classSource = trim(implode('', array_slice(file($fileName), $startLine, $numLines))); // not perfect; if the class starts or ends on the same line as something else, this will be incorrect
            // $hash = crc32($classSource);
        }
        
        return $fileContents;
    }

    public function classWriteMethod($class, $method_name, $method_content) {
        $file = (new \ReflectionClass($class))->getFileName();
        
        if (is_string($class)) {
            $class = app($class);
        }
        
        $source = $this->classSource($class);

        if (method_exists($class, $method_name)) {
            // $source = preg_replace("/\t+public function {$method_name}(.+?)\}/s", $method_content, $source);
        }
        else {
            $source = rtrim(rtrim($source), '}') ."\n{$method_content}\n}";
        }

        file_put_contents($file, $source);
    }

    public function classWriteMethodOld($class, $method_name, $method_content) {
        $class = "{$table['ModelNamespace']}\\{$table['Model']}";

        if (is_string($class)) {
            $class = app($class);
        }
        
        $source = $this->classSource($class);
        dd($source);

        if (method_exists($class, $method_name)) {
            // $source = preg_replace("/\t+public function {$method_name}(.+?)\}/s", $method_content, $source);
        }
        else {
            $source = rtrim(rtrim($source), '}') ."\n{$method_content}\n}";
        }

        file_put_contents(base_path($table['ModelFile']), $source);
    }
}
