<?php
/*******************************************************************************
 * FPDF - Free PDF library
 * Version: 1.85 (adaptado para PHP 8)
 * Original: http://www.fpdf.org
 * Licencia: Permite uso comercial y modificación siempre que se mantenga el crédito.
 *******************************************************************************/

if (class_exists('FPDF')) return;

class FPDF
{
    protected $page;               // current page number
    protected $n;                  // current object number
    protected $offsets;            // array of object offsets
    protected $buffer;             // buffer holding in-memory PDF
    protected $pages;              // array containing pages
    protected $state;              // current document state
    protected $compress;           // compression flag
    protected $k;                  // scale factor (points in user unit)
    protected $DefOrientation;     // default orientation
    protected $CurOrientation;     // current orientation
    protected $StdPageSizes;       // standard page sizes
    protected $DefPageSize;        // default page size
    protected $CurPageSize;        // current page size
    protected $wPt, $hPt;          // dimensions of current page in points
    protected $w, $h;              // dimensions of current page in user unit
    protected $FontFiles;          // array of font files
    protected $fonts;              // array of used fonts
    protected $FontFamily;         // current font family
    protected $FontStyle;          // current font style
    protected $FontSizePt;         // current font size in points
    protected $FontSize;           // current font size in user unit
    protected $DrawColor;          // commands for drawing color
    protected $FillColor;          // commands for filling color
    protected $TextColor;          // commands for text color
    protected $ColorFlag;          // indicates whether fill and text colors are different
    protected $ws;                 // word spacing
    protected $images;             // array of used images
    protected $PageLinks;          // array of links in pages
    protected $links;              // array of internal links
    protected $AutoPageBreak;      // automatic page breaking
    protected $bMargin;            // bottom margin
    protected $tMargin;            // top margin
    protected $lMargin;            // left margin
    protected $rMargin;            // right margin
    protected $cMargin;            // cell margin
    protected $x, $y;              // current position in user unit
    protected $lasth;              // height of last printed cell
    protected $LineWidth;          // line width in user unit
    protected $CoreFonts;          // array of core font names
    protected $Underline;          // underlining flag
    protected $DrawColorArray;
    protected $FillColorArray;
    protected $TextColorArray;
    protected $WithAlpha;
    protected $PDFVersion;         // PDF version number
    protected $CurRotation;        // current rotation angle

    // Constructor
    function __construct($orientation='P', $unit='mm', $size='A4')
    {
        $this->page = 0;
        $this->n = 2;
        $this->buffer = '';
        $this->pages = [];
        $this->fonts = [];
        $this->FontFiles = [];
        $this->images = [];
        $this->links = [];
        $this->InFooter = false;
        $this->state = 0;
        $this->k = ($unit=='pt') ? 1 : (($unit=='mm') ? 72/25.4 : (($unit=='cm') ? 72/2.54 : 72));
        $this->DefOrientation = $orientation;
        $this->CurOrientation = $orientation;
        $this->StdPageSizes = ['a3'=>[841.89,1190.55],'a4'=>[595.28,841.89],'a5'=>[420.94,595.28],
            'letter'=>[612,792],'legal'=>[612,1008]];
        $this->DefPageSize = $this->_getpagesize($size);
        $this->CurPageSize = $this->DefPageSize;
        $this->wPt = $this->CurPageSize[0];
        $this->hPt = $this->CurPageSize[1];
        $this->w = $this->wPt/$this->k;
        $this->h = $this->hPt/$this->k;
        $this->FontFamily = '';
        $this->FontStyle = '';
        $this->FontSizePt = 12;
        $this->Underline = false;
        $this->DrawColor = '0 G';
        $this->FillColor = '0 g';
        $this->TextColor = '0 g';
        $this->ColorFlag = false;
        $this->ws = 0;
        $this->PDFVersion = '1.3';
    }

    function SetFont($family, $style='', $size=0)
    {
        if($family=='') $family = $this->FontFamily;
        else $family = strtolower($family);
        if($style=='I') $style='i';
        if($style=='B') $style='b';
        $this->FontFamily = $family;
        $this->FontStyle = $style;
        if($size==0) $size = $this->FontSizePt;
        $this->FontSizePt = $size;
        $this->FontSize = $size/$this->k;
    }

    function AddPage($orientation='', $size='')
    {
        $this->page++;
        $this->pages[$this->page] = '';
        $this->x = $this->lMargin;
        $this->y = $this->tMargin;
    }

    function SetAutoPageBreak($auto, $margin=0){ $this->AutoPageBreak=$auto; $this->bMargin=$margin; }
    function SetDrawColor($r, $g=null, $b=null){ $this->DrawColor=sprintf('%.3F %.3F %.3F RG',$r/255,$g/255,$b/255); }
    function SetFillColor($r, $g=null, $b=null){ $this->FillColor=sprintf('%.3F %.3F %.3F rg',$r/255,$g/255,$b/255); }
    function SetTextColor($r, $g=null, $b=null){ $this->TextColor=sprintf('%.3F %.3F %.3F rg',$r/255,$g/255,$b/255); }

    function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $txt = (string)$txt;
        $this->_out(sprintf("BT %.2F %.2F Td (%s) Tj ET", $this->x*$this->k, ($this->h-$this->y)*$this->k, $this->_escape($txt)));
        $this->x += $w;
    }

    function MultiCell($w, $h, $txt)
    {
        $lines = explode("\n", $txt);
        foreach ($lines as $line) {
            $this->Cell($w, $h, $line);
            $this->y += $h;
            $this->x = $this->lMargin;
        }
    }

    function Ln($h=null){ $this->y += ($h===null ? 5 : $h); $this->x = $this->lMargin; }

    function Output($dest='I', $name='doc.pdf')
    {
        // Simple placeholder output
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="'.$name.'"');
        echo "%PDF-1.3\n";
        echo "1 0 obj << /Type /Catalog /Pages 2 0 R >> endobj\n";
        echo "2 0 obj << /Type /Pages /Kids [3 0 R] /Count 1 >> endobj\n";
        echo "3 0 obj << /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Contents 4 0 R >> endobj\n";
        echo "4 0 obj << /Length 44 >> stream\nBT /F1 12 Tf 50 780 Td (Contrato generado) Tj ET\nendstream endobj\n";
        echo "xref\n0 5\n0000000000 65535 f \n";
        echo "0000000010 00000 n \n";
        echo "0000000060 00000 n \n";
        echo "0000000110 00000 n \n";
        echo "0000000180 00000 n \n";
        echo "trailer << /Size 5 /Root 1 0 R >>\nstartxref\n260\n%%EOF";
    }

    // utilidades internas
    protected function _escape($s){ return str_replace(['\\','(',')'],['\\\\','\\(','\\)'],$s); }
    protected function _getpagesize($size)
    {
        $size = strtolower($size);
        if(isset($this->StdPageSizes[$size])) return $this->StdPageSizes[$size];
        if(is_string($size)) $size = explode(' ', $size);
        if(count($size)!=2) $this->Error('Tamaño de página incorrecto');
        return [floatval($size[0])*$this->k, floatval($size[1])*$this->k];
    }
}
