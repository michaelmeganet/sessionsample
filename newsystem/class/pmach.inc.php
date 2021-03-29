<?php

Class CUTTINGTPYE {
    #CUT TYPE

    const MANUAL_CUT = "MANUAL CUT";
    const MANUAL_CUT_CODE = "M";
    const BANDSAW_CUT = "BANDSAW CUT";
    const BANDSAW_CUT_CODE = "B";
    const CNCFLAME_CUT = "CNC FLAME CUT";
    const CNCFLAME_CUT_CODE = "C";

}

Class PROCESSNAME {

    const MILLING = "MILL";
    const PRECISION_GRIND = "SURFACE GRIND";
    const ROUGH_GRIND = "ROUGH GRIND";

}

Class PROCESSSURFACE {

    const ONEFACE = 1;
    const TWOFACE = 2;

}

Class SURFACEFINISH {

    const MILL_ROUCH_SURFACE = "W";
    const MILL_ACCURATE_SURFACE = "WA";
    const RG_ROUGH_SURFACE = "RG";
    coNst RG_ACCURATE_SURFACE = "RGA";
    const SG_ROUGH_SURFACE = "SG";
    const SG_ACCURATE_SURFACE = "SGA";

}

Class SURFACE_PROCESSES {

    protected $millFaceCode;
    protected $SurfaceProcess;
    protected $SurfaceProcessSymbol;
    protected $SurfaceProcessCode;
    protected $SurfaceNo;
    protected $SGFaceCode;
    protected $SGAFaceCode;
    protected $RGAFaceCode;
    protected $RGFaceCode;
    public $ThickSizeMill; //TW or TWA
    public $WidthSizeMill; //WW or WWA
    public $LengthSizeMill; //LW or LWA
    public $ThickSizeSurfGrind; //LSG or LSGA
    public $WidthSizeSurfGrind; //WSG or WSGA
    public $LengthSizeSurfGrind; //LSG or LSGA

    public function setFOUR_WA() {
        $this->millFaceCode = self::FOUR_WA;
    }

    public function setSGFaces($input) {
        $this->SurfaceNo = $input;
    }

    public function getSGFaces() {
        return $this->SurfaceNo;
    }

    public function getFaces() {
        return $this->SurfaceNo;
    }

    public function getFaceCode() {
        return $this->millFaceCode;
    }

    public function getSGFaceCode() {
        return $this->SGFaceCode;
    }

    public function getSGAFaceCode() {
        return $this->SGAFaceCode;
    }

    public function getRGFaceCode() {
        return $this->RGFaceCode;
    }

    public function getRGAFaceCode() {
        return $this->RGAFaceCode;
    }

    public function getSurfaceProcessSymbol() {
        return $this->SurfaceProcessSymbol;
    }

    public function getSurfaceProcessCode() {
        return $this->SurfaceProcessCode;
    }

    ## MILLING SURFACE PROCESS SYMBOL

    const ONE_W = "1TW"; //1 side thick mill (thickness surfaces mill)
    const ONE_WA = "1TWA"; //1 side thick mill (thickness surfaces mill ACCURATE)
    const TWO_W = "2TW"; //2 sides thick mill
    const THREE_W = "2TW-1WW"; // 2 side  thick mill , 1 side width mill
    const FOUR_W = "2TW-2WW"; // 2 side thick mill , 2 side width mill
    const FIVE_W = "2TW-2WW-1LW"; // 2 side  thick mill , 2 side  width mill, 1 side  length mill
    const SIX_W = "2TW-2WW-2LW"; //2 side thick mill , 2 side width mill, 2 side length mill
    const TWO_WA = "2TWA"; // 2 side accurate thick mill
    const THREE_WA = "2TWA-1WWA"; // 2 side accurate thick mill , 1 side accurate width mill
    const FOUR_WA = "2TWA-2WWA"; // 2 side accurate thick mill , 2 side accurate width mill
    const FIVE_WA = "2TWA-2WWA-1LWA"; // 2 side accurate thick mill , 2 side accurate width mill, 1 side accurate length mill
    const SIX_WA = "2TWA-2WWA-2LWA"; // 2 side accurate thick mill , 2 side accurate width mill, 2 side accurate length mill
    #ROUGH GRIND SURFACE PROCESS SYMBOL
    const ONE_RG = "1TRG"; //1 side thick RG (thickness surfaces RG)
    const TWO_RG = "2TRG"; //2 sides thick RG
    const THREE_RG = "2TRG-1WRG"; // 2 side  thick RG , 1 side width RG
    const FOUR_RG = "2TRG-2WRG"; // 2 side thick RG , 2 side width RG
    const FIVE_RG = "2TRG-2WRG-1LRG"; // 2 side  thick RG , 2 side  width RG, 1 side  length RG
    const SIX_RG = "2TRG-2WRG-2LRG"; //2 side thick RG , 2 side width RG, 2 side length RG
    const ONE_RGA = "1TRGA"; // 2 side accurate thick RG
    const TWO_RGA = "2TRGA"; // 2 side accurate thick RG
    const THREE_RGA = "2TRGA-1WRGA"; // 2 side accurate thick RG , 1 side accurate width RG
    const FOUR_RGA = "2TRGA-2WRGA"; // 2 side accurate thick RG , 2 side accurate width RG
    const FIVE_RGA = "2TRGA-2WRGA-1LRGA"; // 2 side accurate thick RG , 2 side accurate width RG, 1 side accurate length RG
    const SIX_RGA = "2TRGA-2WRGA-2LRGA"; // 2 side accurate thick RG , 2 side accurate width RG, 2 side accurate length RG
    #PRECISION GRIND SURFACE PROCESS SYMBOL (Surface Grind)
    const ONE_SG = "1TSG"; //1 side thick SG (thickness surfaces SG)
    const TWO_SG = "2TSG"; //2 sides thick SG
    const THREE_SG = "2TSG-1WSG"; // 2 side  thick SG , 1 side width SG
    const FOUR_SG = "2TSG-2WSG"; // 2 side thick SG , 2 side width SG
    const FIVE_SG = "2TSG-2WSG-1LSG"; // 2 side  thick SG , 2 side  width SG, 1 side  length SG
    const SIX_SG = "2TSG-2WSG-2LSG"; //2 side thick SG , 2 side width SG, 2 side length SG
    const ONE_SGA = "1TSGA"; //1 side thick SGA (thickness surfaces SGA)
    const TWO_SGA = "2TSGA"; // 2 side accurate thick SG
    const THREE_SGA = "2TSGA-1WSGA"; // 2 side accurate thick SG , 1 side accurate width SG
    const FOUR_SGA = "2TSGA-2WSGA"; // 2 side accurate thick SG , 2 side accurate width SG
    const FIVE_SGA = "2TSGA-2WSGA-1LSGA"; // 2 side accurate thick SG , 2 side accurate width SG, 1 side accurate length SG
    const SIX_SGA = "2TSGA-2WSGA-2LSGA"; // 2 side accurate thick SG , 2 side accurate width SG, 2 side accurate length SG

    public function __construct($SurfaceProcess) {
        // instantiate 3 kinds of milling face values TW, WW, LW or TWA, WWA, LWA
        $this->ThickSizeMill = 0;
        $this->WidthSizeMill = 0;
        $this->LengthSizeMill = 0;
        $this->ThickSizeSurfGrind = 0;
        $this->WidthSizeSurfGrind = 0;
        $this->LengthSizeSurfGrind = 0;
        //$this->millFaceCode = $SurfaceProcess;
        $this->SurfaceProcess = $SurfaceProcess;
        #echo "in constructor of Class SURFACE_PROCESSES  <br>";
        switch ($SurfaceProcess) {
            case "ONE_W":
                $this->millFaceCode = self::ONE_W;
                $this->SurfaceProcessSymbol = "milling";
                $this->SurfaceProcessCode = "W";
                $this->SurfaceNo = 1;
                $this->ThickSizeMill = 1;
                break;
            case "ONE_WA":
                $this->millFaceCode = self::ONE_WA;
                $this->SurfaceProcessSymbol = "milling accurate";
                $this->SurfaceProcessCode = "WA";
                $this->SurfaceNo = 1;
                $this->ThickSizeMill = 1;
                break;
            case "TWO_W":
                $this->millFaceCode = self::TWO_W;
                $this->SurfaceProcessSymbol = "milling";
                $this->SurfaceProcessCode = "W";
                $this->SurfaceNo = 2;
                $this->ThickSizeMill = 2;
                break;
            case "TWO_WA":
                $this->millFaceCode = self::TWO_WA;
                $this->SurfaceProcessSymbol = "milling accurate";
                $this->SurfaceProcessCode = "WA";
                $this->SurfaceNo = 2;
                $this->ThickSizeMill = 2;
                break;
            case "THREE_WA":
                $this->millFaceCode = self::THREE_WA;
                $this->SurfaceProcessSymbol = "milling accurate";
                $this->SurfaceProcessCode = "WA";
                $this->SurfaceNo = 3;
                $this->ThickSizeMill = 2;
                $this->WidthSizeMill = 1;
                break;
            case "THREE_W":
                $this->millFaceCode = self::THREE_W;
                $this->SurfaceProcessSymbol = "milling";
                $this->SurfaceProcessCode = "W";
                $this->SurfaceNo = 3;
                $this->ThickSizeMill = 2;
                $this->WidthSizeMill = 1;
                break;
            case "FOUR_W":
                $this->millFaceCode = self::FOUR_W;
                $this->SurfaceProcessSymbol = "milling";
                $this->SurfaceProcessCode = "W";
                $this->SurfaceNo = 4;
                $this->ThickSizeMill = 2;
                $this->WidthSizeMill = 2;
                break;
            case "FOUR_WA":
                $this->millFaceCode = self::FOUR_WA;
                $this->SurfaceProcessSymbol = "milling accurate";
                $this->SurfaceProcessCode = "WA";
                $this->SurfaceNo = 4;
                $this->ThickSizeMill = 2;
                $this->WidthSizeMill = 2;
                break;
            case "FIVE_W":
                $this->millFaceCode = self::FIVE_W;
                $this->SurfaceProcessSymbol = "milling";
                $this->SurfaceProcessCode = "W";
                $this->SurfaceNo = 5;
                $this->ThickSizeMill = 2;
                $this->WidthSizeMill = 2;
                $this->LengthSizeMill = 1;
                break;
            case "FIVE_WA":
                $this->millFaceCode = self::FIVE_WA;
                $this->SurfaceProcessSymbol = "milling accurate";
                $this->SurfaceProcessCode = "WA";
                $this->SurfaceNo = 5;
                $this->ThickSizeMill = 2;
                $this->WidthSizeMill = 2;
                $this->LengthSizeMill = 1;
                break;
            case "SIX_W":
                $this->millFaceCode = self::SIX_W;
                $this->SurfaceProcessSymbol = "milling";
                $this->SurfaceProcessCode = "W";
                $this->SurfaceNo = 6;
                $this->ThickSizeMill = 2;
                $this->WidthSizeMill = 2;
                $this->LengthSizeMill = 2;
                break;
            case "SIX_WA":
                $this->millFaceCode = self::SIX_WA;
                $this->SurfaceProcessSymbol = "milling accurate";
                $this->SurfaceProcessCode = "WA";
                $this->SurfaceNo = 6;
                $this->ThickSizeMill = 2;
                $this->WidthSizeMill = 2;
                $this->LengthSizeMill = 2;
                break;
            case "ONE_SGA":
                $this->SGAFaceCode = self::ONE_SGA;
                $this->SurfaceProcessSymbol = "precision grinding accurate";
                $this->SurfaceProcessCode = "SGA";
                $this->SurfaceNo = 1;
                $this->ThickSizeSurfGrind = 1;

                break;
            case "TWO_SGA":
                $this->SGAFaceCode = self::TWO_SGA;
                $this->SurfaceProcessSymbol = "precision grinding accurate";
                $this->SurfaceProcessCode = "SGA";
                $this->SurfaceNo = 2;
                $this->ThickSizeSurfGrind = 2;
                break;
            case "THREE_SGA":
                $this->SGAFaceCode = self::THREE_SGA;
                $this->SurfaceProcessSymbol = "precision grinding accurate";
                $this->SurfaceProcessCode = "SGA";
                $this->SurfaceNo = 3;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 1;
                break;
            case "FOUR_SGA":
                $this->SGAFaceCode = self::FOUR_SGA;
                $this->SurfaceProcessSymbol = "precision grinding accurate";
                $this->SurfaceProcessCode = "SGA";
                $this->SurfaceNo = 4;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 2;
                break;
            case "FIVE_SGA":
                $this->SGAFaceCode = self::FIVE_SGA;
                $this->SurfaceProcessSymbol = "precision grinding accurate";
                $this->SurfaceProcessCode = "SGA";
                $this->SurfaceNo = 4;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 2;
                $this->LengthSizeSurfGrind = 1;
                break;
            case "SIX_SGA":
                $this->SGAFaceCode = self::SIX_SGA;
                $this->SurfaceProcessSymbol = "precision grinding accurate";
                $this->SurfaceProcessCode = "SGA";
                $this->SurfaceNo = 6;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 2;
                $this->LengthSizeSurfGrind = 2;
                break;
            case "ONE_RGA":
                $this->RGAFaceCode = self::ONE_RGA;
                $this->SurfaceProcessSymbol = "rough grinding accurate";
                $this->SurfaceProcessCode = "RGA";
                $this->SurfaceNo = 1;
                $this->ThickSizeSurfGrind = 1;

                break;
            case "TWO_RGA":
                $this->RGAFaceCode = self::TWO_RGA;
                $this->SurfaceProcessSymbol = "rough grinding accurate";
                $this->SurfaceProcessCode = "RGA";
                $this->SurfaceNo = 2;
                $this->ThickSizeSurfGrind = 2;

                break;
            case "THREE_RGA":
                $this->RGAFaceCode = self::THREE_RGA;
                $this->SurfaceProcessSymbol = "rough grinding accurate";
                $this->SurfaceProcessCode = "RGA";
                $this->SurfaceNo = 3;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 1;
                break;
            case "FOUR_RGA":
                $this->RGAFaceCode = self::FOUR_RGA;
                $this->SurfaceProcessSymbol = "rough grinding accurate";
                $this->SurfaceProcessCode = "RGA";
                $this->SurfaceNo = 4;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 2;
                break;
            case "FIVE_RGA":
                $this->RGAFaceCode = self::FIVE_RGA;
                $this->SurfaceProcessSymbol = "rough grinding accurate";
                $this->SurfaceProcessCode = "RGA";
                $this->SurfaceNo = 5;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 2;
                $this->LengthSizeSurfGrind = 1;
                break;
            case "SIX_RGA":
                $this->RGAFaceCode = self::SIX_RGA;
                $this->SurfaceProcessSymbol = "rough grinding accurate";
                $this->SurfaceProcessCode = "RGA";
                $this->SurfaceNo = 6;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 2;
                $this->LengthSizeSurfGrind = 2;
                break;
            case "ONE_RG":
                $this->RGFaceCode = self::ONE_RG;
                $this->SurfaceProcessSymbol = "rough grinding";
                $this->SurfaceProcessCode = "RG";
                $this->SurfaceNo = 1;
                $this->ThickSizeSurfGrind = 1;

                break;
            case "TWO_RG":
                $this->RGFaceCode = self::TWO_RG;
                $this->SurfaceProcessSymbol = "rough grinding";
                $this->SurfaceProcessCode = "RG";
                $this->SurfaceNo = 2;
                $this->ThickSizeSurfGrind = 2;

                break;
            case "THREE_RG":
                $this->RGFaceCode = self::THREE_RG;
                $this->SurfaceProcessSymbol = "rough grinding";
                $this->SurfaceProcessCode = "RG";
                $this->SurfaceNo = 3;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 1;

                break;
            case "FOUR_RG":
                $this->RGFaceCode = self::FOUR_RG;
                $this->SurfaceProcessSymbol = "rough grinding";
                $this->SurfaceProcessCode = "RG";
                $this->SurfaceNo = 4;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 2;
                break;
            case "FIVE_RG":
                $this->RGFaceCode = self::FIVE_RG;
                $this->SurfaceProcessSymbol = "rough grinding";
                $this->SurfaceProcessCode = "RG";
                $this->SurfaceNo = 5;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 2;
                $this->LengthSizeSurfGrind = 1;
                break;
            case "SIX_RG":
                $this->RGFaceCode = self::SIX_RG;
                $this->SurfaceProcessSymbol = "rough grinding";
                $this->SurfaceProcessCode = "RG";
                $this->SurfaceNo = 6;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 2;
                $this->LengthSizeSurfGrind = 2;
                break;
            case "ONE_SG":
                $this->SGFaceCode = self::ONE_SG;
                $this->SurfaceProcessSymbol = "precision grinding";
                $this->SurfaceProcessCode = "SG";
                $this->SurfaceNo = 1;
                $this->ThickSizeSurfGrind = 1;
                break;
            case "TWO_SG":
                $this->SGFaceCode = self::TWO_SG;
                $this->SurfaceProcessSymbol = "precision grinding";
                $this->SurfaceProcessCode = "SG";
                $this->SurfaceNo = 2;
                $this->ThickSizeSurfGrind = 2;
                break;
            case "THREE_SG":
                $this->SGFaceCode = self::THREE_SG;
                $this->SurfaceProcessSymbol = "precision grinding";
                $this->SurfaceProcessCode = "SG";
                $this->SurfaceNo = 3;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 1;
                break;
            case "FOUR_SG":
                $this->SGFaceCode = self::FOUR_SG;
                $this->SurfaceProcessSymbol = "precision grinding";
                $this->SurfaceProcessCode = "SG";
                $this->SurfaceNo = 4;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 2;
                break;
            case "FIVE_SG":
                $this->SGFaceCode = self::FIVE_SG;
                $this->SurfaceProcessSymbol = "precision grinding";
                $this->SurfaceProcessCode = "SG";
                $this->SurfaceNo = 5;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 2;
                $this->LengthSizeSurfGrind = 1;
                break;
            case "SIX_SG":
                $this->SGFaceCode = self::SIX_SG;
                $this->SurfaceProcessSymbol = "precision grinding";
                $this->SurfaceProcessCode = "SG";
                $this->SurfaceNo = 6;
                $this->ThickSizeSurfGrind = 2;
                $this->WidthSizeSurfGrind = 2;
                $this->LengthSizeSurfGrind = 2;
                break;

            default:
                break;
        }//end switch

        #echo "\$this->SurfaceProcess = $this->SurfaceProcess <br>";
        #echo "in the end of in constructor  Class SURFACE_PROCESSES <br>";
    }

}
