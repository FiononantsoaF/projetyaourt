<?php

class SimpleXLSXGen {
    private $data;

    public static function fromArray(array $data): self {
        $instance = new self();
        $instance->data = $data;
        return $instance;
    }

    public function download(string $filename): void {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        echo $this->generateXLSX();
        exit;
    }

    private function generateXLSX(): string {
        $data = $this->data;
        $xmlData = $this->buildWorksheet($data);
        
        $zip = new \ZipArchive();
        $filename = "temp.xlsx";

        if ($zip->open($filename, \ZipArchive::CREATE) !== true) {
            throw new \Exception("Could not open archive");
        }

        $zip->addFromString('xl/workbook.xml', $this->generateWorkbookXML());
        $zip->addFromString('xl/worksheets/sheet1.xml', $xmlData);
        $zip->addFromString('[Content_Types].xml', $this->generateContentTypesXML());
        
        $zip->close();
        return file_get_contents($filename);
    }

        private function buildWorksheet(array $data): string {
            $xml = <<<XML
    <?xml version="1.0" encoding="UTF-8" standalone="yes"?>
    <worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
    <dimension ref="A1"/>
    <sheetData>
    XML;

            foreach ($data as $row) {
                $xml .= '<row>';
                foreach ($row as $cell) {
                    $xml .= '<c t="inlineStr"><is><t>' . htmlspecialchars($cell) . '</t></is></c>';
                }
                $xml .= '</row>';
            }

            $xml .= <<<XML
    </sheetData>
    </worksheet>
    XML;

            return $xml;
        }

        private function generateWorkbookXML(): string {
            return <<<XML
    <?xml version="1.0" encoding="UTF-8" standalone="yes"?>
    <workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
        <sheets>
            <sheet name="Sheet1" sheetId="1" r:id="rId1"/>
        </sheets>
    </workbook>
    XML;
        }

        private function generateContentTypesXML(): string {
            return <<<XML
    <?xml version="1.0" encoding="UTF-8" standalone="yes"?>
    <Types xmlns="http://schemas.openxmlformats.org/package/2006/metadata/core-properties">
        <Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main"/>
        <Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.worksheet+xml"/>
    </Types>
    XML;
        }
    }
