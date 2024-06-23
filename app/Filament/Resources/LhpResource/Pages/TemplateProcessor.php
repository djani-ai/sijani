<?php

use PhpOffice\PhpWord\Element\TextBox;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\Shared\XMLWriter;
use PhpOffice\PhpWord\TemplateProcessor as PhpWordTemplateProcessor;
use PhpOffice\PhpWord\Writer\Word2007\Element\Container;

class TemplateProcessor extends PhpWordTemplateProcessor {

    public function setHtmlBlockValue($search, $markup)
    {
        $wrapper = new TextBox();
        Html::addHtml($wrapper, $markup);

        // Render the child elements of the container.
        $xmlWriter = new XMLWriter();
        $containerWriter = new Container($xmlWriter, $wrapper, false);
        $containerWriter->write();

        // Replace the macro parent block with the rendered contents.
        $this->replaceXmlBlock($search, $xmlWriter->getData(), 'w:p');
    }

}
