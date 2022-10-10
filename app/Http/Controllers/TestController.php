<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TestController extends Controller
{
  protected $data = [];
  protected $dataHeader = [];
  public function __construct()
  {
    $files = storage_path('/app/companies.csv');
    $file = fopen($files, "r");
    $build = [];
    while (($getData = fgetcsv($file, 1000, ",")) !== FALSE) {
      array_push($build, array(
        "CMGUnmaskedID" => $getData[0] ?: '',
        "CMGUnmaskedName" => $getData[1] ?: '',
        "ClientTier" => $getData[2] ?: '',
        "GCPStream" => $getData[3] ?: '',
        "GCPBusiness" => $getData[4] ?: '',
        "CMGGlobalBU" => $getData[5] ?: '',
        "CMGSegmentName" => $getData[6] ?: '',
        "GlobalControlPoint" => $getData[7] ?: '',
        "GCPGeography" => $getData[8] ?: '',
        "GlobalRelationshipManagerName" => $getData[9] ?: '',
        "REVENUE_FY14" => $getData[10] ?: '',
        "REVENUE_FY15" => $getData[11] ?: '',
        "Deposits_EOP_FY14" => $getData[12] ?: '',
        "Deposits_EOP_FY15x" => $getData[13] ?: '',
        "TotalLimits_EOP_FY14" => $getData[14] ?: '',
        "TotalLimits_EOP_FY15" => $getData[15] ?: '',
        "TotalLimits_EOP_FY15x" => $getData[16] ?: '',
        "RWAFY15" => $getData[17] ?: '',
        "RWAFY14" => $getData[18] ?: '',
        "REV/RWA_FY14" => $getData[19] ?: '',
        "REV/RWA_FY15" => $getData[20] ?: '',
        "NPAT_AllocEq_FY14" => $getData[21] ?: '',
        "NPAT_AllocEq_FY15X" => $getData[22] ?: '',
        "Company_Avg_Activity_FY14" => $getData[23] ?: '',
        "Company_Avg_Activity_FY15" => $getData[24] ?: '',
        "ROE_FY14" => $getData[25] ?: '',
        "ROE_FY15" => $getData[26] ?: '',
      ));
    }
    $this->dataHeader = $build[0];
    unset($build[0]);
    $reIndex = array_values($build);
    $this->data = $reIndex;
    fclose($file);
  }
  public function index()
  {
    return view('layouts');
  }
  public function table(Request $request)
  {
    $collection = collect($this->data);
    if ($request->ajax()) {
      $company = $request->input('company');
      $tier = $request->input('tier');
      $segment = $request->input('segment');
      $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length");
      // Fetch records
      if (isset($company) || isset($tier) || isset($segment)) {
        $records = $collection
          ->filter(function ($item) use ($company, $tier, $segment) {
            if (!empty($company)) {
              return false !== stristr($item['CMGUnmaskedName'], Str::replace('-', ' ', $company));
            } elseif (!empty($tier)) {
              return false !== stristr($item['ClientTier'], Str::replace('-', ' ', $tier));
            } elseif (!empty($segment)) {
              return false !== stristr($item['CMGSegmentName'], Str::replace('-', ' ', $segment));
            }
          })->skip($start)->take($rowperpage)->all();
      } else {
        $records = $collection
          ->skip($start)
          ->take($rowperpage)
          ->all();
      }
      $countAll = count($this->data);
      $totalRecords = $countAll;
      $totalRecordswithFilter = $countAll;
      $data_arr = array();
      if (!empty($records)) {
        foreach ($records as $record) {
          $data_arr[] = array(
            '<a class="text-decoration-none" style="cursor:pointer" onclick="showDetail(`' . $record['CMGUnmaskedID'] . '`,`' . $record['CMGUnmaskedName'] . '`)">' . $record['CMGUnmaskedID'] . '</a>',
            $record['CMGUnmaskedName'],
            $record['ClientTier'],
            $record['GCPStream'],
            $record['GCPBusiness'],
            $record['CMGGlobalBU'],
            $record['CMGSegmentName'],
            $record['GlobalControlPoint'],
            $record['GCPGeography'],
            $record['GlobalRelationshipManagerName'],
            $record['REVENUE_FY14'],
            $record['REVENUE_FY15'],
            $record['Deposits_EOP_FY14'],
            $record['Deposits_EOP_FY15x'],
            $record['TotalLimits_EOP_FY14'],
            $record['TotalLimits_EOP_FY15'],
            $record['TotalLimits_EOP_FY15x'],
            $record['RWAFY15'],
            $record['RWAFY14'],
            $record['REV/RWA_FY14'],
            $record['REV/RWA_FY15'],
            $record['NPAT_AllocEq_FY14'],
            $record['NPAT_AllocEq_FY15X'],
            $record['Company_Avg_Activity_FY14'],
            $record['Company_Avg_Activity_FY15'],
            $record['ROE_FY14'],
            $record['ROE_FY15'],
          );
        }
      }
      $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordswithFilter,
        "aaData" => $data_arr
      );
      return response()->json($response);
    } else {
      abort('404');
    }
  }
  public function detail(Request $request)
  {
    if ($request->ajax()) {
      $id = $request->input('id');
      if (!empty($id)) {
        $collection = collect($this->data);
        $data = $collection->where('CMGUnmaskedID', $id)->first();
        $response['status'] = true;
        $response['data'] = $data;
      } else {
        $response['status'] = false;
        $response['msg'] = "ID Not Found";
      }
      return response()->json($response);
    } else {
      abort('404');
    }
  }
  public function update(Request $request)
  {
    $model_id = $request->input('model_id');
    $roe_14 = $request->input('roe_14');
    $roe_15 = $request->input('roe_15');
    $revenue_14 = $request->input('revenue_14');
    $revenue_15 = $request->input('revenue_15');
    $rwafy_14 = $request->input('rwafy_14');
    $rwafy_15 = $request->input('rwafy_15');
    $limit_14 = $request->input('limit_14');
    $limit_15 = $request->input('limit_15');
    $avg_14 = $request->input('avg_14');
    $avg_15 = $request->input('avg_15');
    $deposit_14 = $request->input('deposit_14');
    $deposit_15 = $request->input('deposit_15');
    $npat_14 = $request->input('npat_14');
    $npat_15 = $request->input('npat_15');
    // Target
    $headerArr = [];
    array_push($headerArr, $this->dataHeader);
    $newData = array_merge($headerArr, $this->data);
    $arrayIndex = $this->searchForId($model_id, $newData);
    $newData[$arrayIndex]['ROE_FY14'] = !empty($roe_14) ? $roe_14 . '%' : '0';
    $newData[$arrayIndex]['ROE_FY15'] = !empty($roe_15) ? $roe_15 . '%' : '0';
    $newData[$arrayIndex]['REVENUE_FY14'] = !empty($revenue_14) ? $this->convertInt($revenue_14) : '0';
    $newData[$arrayIndex]['REVENUE_FY15'] = !empty($revenue_15) ? $this->convertInt($revenue_15) : '0';
    $newData[$arrayIndex]['RWAFY14'] = !empty($rwafy_14) ? $this->convertInt($rwafy_14) : '0';
    $newData[$arrayIndex]['RWAFY15'] = !empty($rwafy_15) ? $this->convertInt($rwafy_15) : '0';
    $newData[$arrayIndex]['TotalLimits_EOP_FY14'] = !empty($limit_14) ? $this->convertInt($limit_14) : '0';
    $newData[$arrayIndex]['TotalLimits_EOP_FY15'] = !empty($limit_15) ? $this->convertInt($limit_15) : '0';
    $newData[$arrayIndex]['Company_Avg_Activity_FY14'] = !empty($avg_14) ? $this->convertInt($avg_14) : '0';
    $newData[$arrayIndex]['Company_Avg_Activity_FY15'] = !empty($avg_15) ? $this->convertInt($avg_15) : '0';
    $newData[$arrayIndex]['Deposits_EOP_FY14'] = !empty($deposit_14) ? $this->convertInt($deposit_14) : '0';
    $newData[$arrayIndex]['Deposits_EOP_FY15x'] = !empty($deposit_15) ? $this->convertInt($deposit_15) : '0';
    $newData[$arrayIndex]['NPAT_AllocEq_FY14'] = !empty($npat_14) ? $this->convertInt($npat_14) : '0';
    $newData[$arrayIndex]['NPAT_AllocEq_FY15X'] = !empty($npat_15) ? $this->convertInt($npat_15) : '0';
    // Update CSV
    $files = storage_path('/app/companies.csv');
    $fp = fopen($files, "w");
    foreach ($newData as $rows) {
      fputcsv($fp, $rows);
    }
    fclose($fp);
    $response['status'] = true;
    return response()->json($response);
  }
  function searchForId($id, $array)
  {
    foreach ($array as $key => $val) {
      if ($val['CMGUnmaskedID'] === $id) {
        return $key;
      }
    }
    return null;
  }
  function convertInt($val)
  {
    $new = str_replace('.', ',', $val);
    return $new;
  }
  public function selectCompany(Request $request)
  {
    if ($request->ajax()) {
      $search = $request->input('search');
      $collection = collect($this->data);
      if (!empty($search)) {
        $records = $collection->filter(function ($item) use ($search) {
          return false !== stristr($item['CMGUnmaskedName'], $search);
        })->takeUntil(25)->all();
      } else {
        $records = $collection->take(25)
          ->all();
      }
      $response = array();
      foreach ($records as $v) {
        $response[] = array(
          "id" => Str::slug($v['CMGUnmaskedName']),
          "text" => $v['CMGUnmaskedName']
        );
      }
      echo json_encode($response);
    } else {
      abort('404');
    }
  }
  public function selectTiers(Request $request)
  {
    $collectionInit = collect($this->data);
    $inits = $collectionInit->pluck('ClientTier')->all();
    $buildArr = [];
    foreach ($inits as $v) {
      if (!in_array($v, $buildArr)) {
        $buildArr[] = $v;
      }
    }
    if ($request->ajax()) {
      $search = $request->input('search');
      $collection = collect($buildArr);
      if (!empty($search)) {
        $records = $collection->filter(function ($item) use ($search) {
          return false !== stristr($item, $search);
        })->takeUntil(25)->all();
      } else {
        $records = $collection->take(25)->all();
      }
      $response = array();
      foreach ($records as $v) {
        $response[] = array(
          "id" => Str::slug($v),
          "text" => $v
        );
      }
      echo json_encode($response);
    } else {
      abort('404');
    }
  }
  public function selectSegment(Request $request)
  {
    $collectionInit = collect($this->data);
    $inits = $collectionInit->pluck('CMGSegmentName')->all();
    $buildArr = [];
    foreach ($inits as $v) {
      if (!in_array($v, $buildArr)) {
        $buildArr[] = $v;
      }
    }
    if ($request->ajax()) {
      $search = $request->input('search');
      $collection = collect($buildArr);
      if (!empty($search)) {
        $records = $collection->filter(function ($item) use ($search) {
          return false !== stristr($item, $search);
        })->takeUntil(25)->all();
      } else {
        $records = $collection->take(25)
          ->all();
      }
      $response = array();
      foreach ($records as $v) {
        $response[] = array(
          "id" => Str::slug($v),
          "text" => $v
        );
      }
      echo json_encode($response);
    } else {
      abort('404');
    }
  }
}
