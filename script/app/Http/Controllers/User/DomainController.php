<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\Option;
use App\Models\Tenant;
use Auth;
use Str;
class DomainController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subdomainStore(Request $request,$id)
    {
        $info=Tenant::where('user_id',Auth::id())->findorFail($id);
        $check_before= Domain::where([['tenant_id',$id],['type',1]])->first();
        if (!empty($check_before)) {
            $error['errors']['domain']='Oops you already subdomain created....!!';
            return response()->json($error,422);
        }

        $plan= $info;
        if (!empty($plan)) {
            if ($plan->sub_domain == 1) {
                 $validatedData = $request->validate([
                    'subdomain' => 'required|string|max:50',
                 ]);

                 $domain=strtolower(Str::slug($request->subdomain)).'.'.env('APP_PROTOCOLESS_URL');
                 $input = trim($domain, '/');
                 if (!preg_match('#^http(s)?://#', $input)) {
                    $input = 'http://' . $input;
                 }
                $urlParts = parse_url($input);
                $domain = preg_replace('/^www\./', '', $urlParts['host'] ?? $urlParts['path']);
                

                $check= Domain::where('domain',$domain)->first();
                if (!empty($check)) {
                    $error['errors']['domain']='Oops domain name already taken....!!';
                    return response()->json($error,422);
                }

                $subdomain= new Domain;
                $subdomain->domain= $domain;
                $subdomain->tenant_id= $id;
                if (env('AUTO_SUBDOMAIN_APPROVE') == true) {
                   $subdomain->status=1;
                }
                else{
                    $subdomain->status=2;
                }
                $subdomain->type=1;
                $subdomain->save();

                return response()->json('Subdomain Created Successfully...!!');
            }

            $error['errors']['domain']='Sorry subdomain modules not support in your plan....!!';
            return response()->json($error,422);
        }
        $error['errors']['domain']='Opps something wrong...!!';
        return response()->json($error,422);
        
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subdomainUpdate(Request $request, $id)
    {
        $info=Tenant::where('user_id',Auth::id())->findorFail($id);

        $plan= $info;
        if (!empty($plan)) {
            if ($plan->sub_domain == 1) {
                 $validatedData = $request->validate([
                    'subdomain' => 'required|string|max:50',
                 ]);

                 $domain=strtolower($request->subdomain).'.'.env('APP_PROTOCOLESS_URL');
                 $input = trim($domain, '/');
                 if (!preg_match('#^http(s)?://#', $input)) {
                    $input = 'http://' . $input;
                 }
                $urlParts = parse_url($input);
                $domain = preg_replace('/^www\./', '', $urlParts['host'] ?? $urlParts['path']);
                

                $check= Domain::where('domain',$domain)->where('tenant_id','!=',$id)->first();
                if (!empty($check)) {
                    $error['errors']['domain']='Oops domain name already taken....!!';
                    return response()->json($error,422);
                }

                $subdomain= Domain::where([['tenant_id',$id],['type',1]])->first();
                $subdomain->domain= $domain;                
                $subdomain->save();

                return response()->json('Subdomain Updated Successfully...!!');
            }

            $error['errors']['domain']='Sorry subdomain modules not support in your plan....!!';
            return response()->json($error,422);
        }
        $error['errors']['domain']='Opps something wrong...!!';
        return response()->json($error,422);
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function customdomainStore(Request $request,$id)
     {
         $checkisvalid=$this->is_valid_domain_name($request->domain);
         if ($checkisvalid == false) {
            $error['errors']['domain']='Please enter valid domain....!!';
           return response()->json($error,422);
        }



        $info=Tenant::where('user_id',Auth::id())->findorFail($id);
        $check_before= Domain::where([['tenant_id',$id],['type',2]])->first();
        if (!empty($check_before)) {
            $error['errors']['domain']='Oops you already customdomain created....!!';
            return response()->json($error,422);
        }

        $plan= $info;
        if (!empty($plan)) {
            if ($plan->custom_domain == 1) {
                 $validatedData = $request->validate([
                    'domain' => 'required|string|max:50',
                 ]);

                 $domain=strtolower($request->domain);
                 $input = trim($domain, '/');
                 if (!preg_match('#^http(s)?://#', $input)) {
                    $input = 'http://' . $input;
                 }
                $urlParts = parse_url($input);
                $domain = preg_replace('/^www\./', '', $urlParts['host'] ?? $urlParts['path']);
                
                $checkArecord=$this->dnscheckRecordA($domain);
                $checkCNAMErecord=$this->dnscheckRecordCNAME($domain);
                if ($checkArecord != true) {
                  $error['errors']['domain']='A record entered incorrectly.';
                  return response()->json($error,422);
                }

                if ($checkCNAMErecord != true) {
                    $error['errors']['domain']='CNAME record entered incorrectly.';
                    return response()->json($error,422);
                }

                $check= Domain::where('domain',$domain)->first();
                if (!empty($check)) {
                    $error['errors']['domain']='Oops domain name already taken....!!';
                    return response()->json($error,422);
                }

                $subdomain= new Domain;
                $subdomain->domain= $domain;
                $subdomain->tenant_id= $id;
                $subdomain->status=2;
                $subdomain->type=2;
                $subdomain->save();

                return response()->json('Custom Domain Created Successfully...!!');
            }

            $error['errors']['domain']='Sorry custom domain modules not support in your plan....!!';
            return response()->json($error,422);
        }
        $error['errors']['domain']='Opps something wrong...!!';
        return response()->json($error,422);
     }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customdomainUpdate(Request $request, $id)
    {
        $checkisvalid=$this->is_valid_domain_name($request->domain);
        if ($checkisvalid == false) {
            $error['errors']['domain']='Please enter valid domain....!!';
           return response()->json($error,422);
        }

        $info=Tenant::where('user_id',Auth::id())->findorFail($id);

        $plan= $info;
        if (!empty($plan)) {
            if ($plan->custom_domain == 1) {
                 $validatedData = $request->validate([
                    'domain' => 'required|string|max:50',
                 ]);

                 $domain=strtolower($request->domain);
                 $input = trim($domain, '/');
                 if (!preg_match('#^http(s)?://#', $input)) {
                    $input = 'http://' . $input;
                 }
                $urlParts = parse_url($input);
                $domain = preg_replace('/^www\./', '', $urlParts['host'] ?? $urlParts['path']);
                

                $check= Domain::where('domain',$domain)->where('tenant_id','!=',$id)->first();
                if (!empty($check)) {
                    $error['errors']['domain']='Oops domain name already taken....!!';
                    return response()->json($error,422);
                }

                $custom_domain= Domain::where([['tenant_id',$id],['type',2]])->first();
                if ($custom_domain->domain != $domain) {
                  $checkArecord=$this->dnscheckRecordA($domain);
                  $checkCNAMErecord=$this->dnscheckRecordCNAME($domain);
                  if ($checkArecord != true) {
                    $error['errors']['domain']='A record entered incorrectly.';
                    return response()->json($error,422);
                  }

                  if ($checkCNAMErecord != true) {
                    $error['errors']['domain']='CNAME record entered incorrectly.';
                    return response()->json($error,422);
                  }
                }

                $custom_domain->domain= $domain;                
                $custom_domain->save();

                return response()->json('Custom Domain Updated Successfully...!!');
            }

            $error['errors']['domain']='Sorry subdomain modules not support in your plan....!!';
            return response()->json($error,422);
        }
        $error['errors']['domain']='Opps something wrong...!!';
        return response()->json($error,422);
    }



     //destroy subdomain
    public function destroy($id)
    {

        $info=Tenant::where('user_id',Auth::id())->findorFail($id);
        $subdomain= Domain::where([['tenant_id',$id],['type',1]])->delete();

        return back();
    }

    //destroy custom domain

    public function destroyCustomdomain($id)
    {
       
        $info=Tenant::where('user_id',Auth::id())->findorFail($id);
        $subdomain= Domain::where([['tenant_id',$id],['type',2]])->delete();
        return back();
    }

    //check is valid domain name
    public function is_valid_domain_name($domain_name)
    {
      if(filter_var(gethostbyname($domain_name), FILTER_VALIDATE_IP))
      {
        return TRUE;
      }
      return false;
   }

   //check A record
   public function dnscheckRecordA($domain)
   {
    if (env('MOJODNS_AUTHORIZATION_TOKEN') != null  && env('VERIFY_IP') == true) {
        try {
          $response=Http::withHeaders(['Authorization'=>env('MOJODNS_AUTHORIZATION_TOKEN')])->acceptJson()->get('https://api.mojodns.com/api/dns/'.$domain.'/A');
          $ip= $response['answerResourceRecords'][0]['ipAddress'];

          if ($ip == env('SERVER_IP')) {
              $ip= true;
          }
          else{
            $ip=false;
          }

        } catch (Exception $e) {
          $ip=false;
        }

        return $ip;
    }
     
     return true;
   } 


   //check crecord name
   public function dnscheckRecordCNAME($domain)
   {
    if (env('MOJODNS_AUTHORIZATION_TOKEN') != null) {
        if (env('VERIFY_CNAME') === true) {
        try {
          $response=Http::withHeaders(['Authorization'=>env('MOJODNS_AUTHORIZATION_TOKEN')])->acceptJson()->get('https://api.mojodns.com/api/dns/'.$domain.'/CNAME');
          if ($response->successful()) {
            $cname= $response['reportingNameServer'];

            if ($cname === env('CNAME_DOMAIN')) {
              $cname= true;
          }
          else{
           $cname=false;
        }

        } 
        else{
            $cname=false;
        }
              
          }
          catch (Exception $e) {
              $cname=false;
          }
          

        return $cname;
       }
      }
     
     return true;
   }
    
}
