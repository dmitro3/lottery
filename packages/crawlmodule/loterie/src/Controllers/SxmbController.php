<?php
namespace crawlmodule\loterie\Controllers;
use crawlmodule\loterie\Models\{
    SxmbTime,
    SxmbResult,
    SxmbResultType
};
class SxmbController extends Controller
{
    const SXMB_KETQUA_LINK = 'https://ketqua1.net/xo-so-mien-bac.php?ngay=%s';
    const SXMB_MINHNGOC_LINK = 'https://www.minhngoc.net/ket-qua-xo-so/mien-bac/%s.html';
    public function doCrawl()
    {
        @include ('simple_html_dom.php');
        $currentCrawlTimeRecord = SxmbTime::getCurrentCrawlTimeRecord();
        $timeString = $currentCrawlTimeRecord->day.'-'.$currentCrawlTimeRecord->month.'-'.$currentCrawlTimeRecord->year;
        $ketQuaCrawlLink = vsprintf(self::SXMB_KETQUA_LINK,[$timeString]);
        $minhNgovCrawlLink = vsprintf(self::SXMB_MINHNGOC_LINK,[$timeString]);
        if ($this->urlExists($ketQuaCrawlLink)) {
            if ($this->crawlByKetQua($currentCrawlTimeRecord,$ketQuaCrawlLink)) {
                return 'Thành công';
            }
        }
        if ($this->urlExists($minhNgovCrawlLink)) {
            if ($this->crawlByMinhNgoc($currentCrawlTimeRecord,$minhNgovCrawlLink)) {
                return 'Thành công';
            }
        }
        return 'Thất bại';
    }
    public function crawlByKetQua($currentCrawlTimeRecord,$ketQuaCrawlLink)
    {
        SxmbResult::where('sxmb_time_id',$currentCrawlTimeRecord->id)->delete();
        $html = $this->exeCurl($ketQuaCrawlLink);
        $htmlDom = str_get_html($html);
        $tableKetQuas = $htmlDom->find('table[id=result_tab_mb]');
        if (count($tableKetQuas) < 1) {
            return false;
        }
        $tableKetQua = $tableKetQuas[0];
        $trList = $tableKetQua->find('tbody tr');
        $listSxmbResultType = SxmbResultType::get();
        $dataInsert = [];
        foreach ($listSxmbResultType as $key => $itemSxmbResultType) {
            if (isset($trList[$key])) {
                $listDivValue = $trList[$key]->find('.phoi-size');
                foreach ($listDivValue as $itemDivValue) {
                    $dataAdd = [];
                    $dataAdd['sxmb_time_id'] = $currentCrawlTimeRecord->id;
                    $dataAdd['sxmb_result_type_id'] = $itemSxmbResultType->id;
                    $dataAdd['value'] = $itemDivValue->innertext;
                    array_push($dataInsert,$dataAdd);
                }
            }
        }
        if (count($dataInsert) > 0) {
            SxmbResult::insert($dataInsert);
            return true;
        }else {
            return false;
        }
    }
    public function crawlByMinhNgoc($currentCrawlTimeRecord,$minhNgovCrawlLink)
    {
        SxmbResult::where('sxmb_time_id',$currentCrawlTimeRecord->id)->delete();
        $html = $this->exeCurl($minhNgovCrawlLink);
        $htmlDom = str_get_html($html);
        $tableKetQuas = $htmlDom->find('.bkqtinhmienbac');
        if (count($tableKetQuas) < 1) {
            return false;
        }
        $tableKetQua = $tableKetQuas[0];
        $trList = $tableKetQua->find('tbody tr');
        $listSxmbResultType = SxmbResultType::get();
        $dataInsert = [];
        foreach ($listSxmbResultType as $key => $itemSxmbResultType) {
            if (isset($trList[$key])) {
                if ($key == 0) {
                    $loaiveContent = $trList[$key]->find('.loaive_content');
                    if (count($loaiveContent) > 0) {
                        $dataAdd = [];
                        $dataAdd['sxmb_time_id'] = $currentCrawlTimeRecord->id;
                        $dataAdd['sxmb_result_type_id'] = $itemSxmbResultType->id;
                        $dataAdd['value'] = $loaiveContent[0]->innertext;
                        array_push($dataInsert,$dataAdd);
                    }
                }else{
                    $listDivValue = $trList[$key]->find('div');
                    foreach ($listDivValue as $itemDivValue) {
                        $dataAdd = [];
                        $dataAdd['sxmb_time_id'] = $currentCrawlTimeRecord->id;
                        $dataAdd['sxmb_result_type_id'] = $itemSxmbResultType->id;
                        $dataAdd['value'] = $itemDivValue->innertext;
                        array_push($dataInsert,$dataAdd);
                    }
                }
            }
        }
        if (count($dataInsert) > 0) {
            SxmbResult::insert($dataInsert);
            return true;
        }else {
            return false;
        }
    }
}