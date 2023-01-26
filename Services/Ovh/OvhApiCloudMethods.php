<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Rafael\OvhApi\Service\Ovh;

/**
 * Description of OvhApiMethods
 * @author git rafaelssilva35
 * @author rafael silva e silva
 */
class OvhApiCloudMethods {
    
    private $ovh; // ovh connection                                                              
    private $project_id; // project id
    private $network = null;
    
    /**
     * 
     * @param \Modules\OvhApi\Service\Ovh\OvhConn $ovh_conn
     * @param type $project
     * @param type $network_id
     */
    public function __construct($project = null, $network_id = NULL) 
    {
        $ovh_conn = new OvhConn();
        $projectId = $project ?? 'A';
        $this->project_id = config('ovhapi.ovh_config.projects.'.$projectId);
        $this->network = config('ovhapi.ovh_config.network_ids.'.$network_id??'A');
        $this->ovh = $ovh_conn->getConn();
    }
    
    /**
     * get instances
     * @return type
     */
    public function getInstances()
    {
        return $this->ovh->get('/cloud/project/'.$this->project_id.'/instance', array(
        
        ));
    }
    
    /**
     * get a instace
     * @param type $instance_id
     * @return type
     */
    public function getInstance($instance_id)
    {
        $result = $this->ovh->get('/cloud/project/'.$this->project_id.'/instance/'.$instance_id);
       
        return $result;
    }
    
    /**
     * 
     * @return typeget all interfaces
     */
    public function getIntefaces()
    {
        $result = $this->ovh->get('/cloud/project/'.$this->project_id.'/instance/{instanceId}/interface');
        return $result;
    }
            
    /**
     * Create a new instance
     * 
     * @param string $flavorId
     * @param string $groupId
     * @param string $imageId = null
     * @param bool $monthlyBilling
     * @param string $name
     * @param array $network = null
     * @param array $region = null
     * @param string $sshKeyId = null
     * @param string $userData = null
     * @param string $volumeId = null
     * @return type
     */
    public function createNewInstance(string $flavorId, string $groupId = NULL, string $imageId, bool $monthlyBilling = false, string $name, array $network = null, array $region = NULL, string $sshKeyId = NULL, string $userData = null, string $volumeId = null)
    {
        $result = $this->ovh->post('/cloud/project/'.$this->project_id.'/instance', array(
            'flavorId' => $flavorId, // Instance flavor id (type: string)
            'groupId' => $groupId, // Start instance in group (type: string)
            'imageId' => $imageId, // Instance image id (type: string)
            'monthlyBilling' => $monthlyBilling, // Active monthly billing (type: boolean)
            'name' => $name, // Instance name (type: string)
            'networks' => $networks, // Create network interfaces (type: cloud.instance.NetworkParams[])
            'region' => $region, // Instance region (type: string)
            'sshKeyId' => $sshKeyIdId, // SSH keypair id (type: string)
            'userData' => $userData,// Configuration information or scripts to use upon launch (type: text)
            'volumeId' => $volumeId// Specify a volume id to boot from it (type: string)
        ));
        return $result;
    }
    
    /**
     * Create multiple instances
     * @param string $flavorId
     * @param string $groupId
     * @param string $imageId
     * @param bool $monthlyBilling
     * @param string $name
     * @param array $network
     * @param int $number
     * @param array $region
     * @param string $sshKeyId
     * @param string $userData
     * @param string $volumeId
     * @return type
     */
    public function createMultipleInstances(string $flavorId, string $groupId = NULL, string $imageId, bool $monthlyBilling = false, string $name, array $network = null, int $number = null, array $region = NULL, string $sshKeyId = NULL, string $userData = null, string $volumeId = null)
    {
        $result = $this->ovh->post('/cloud/project/'.$this->project_id.'/instance/bulk', array(
            'flavorId' => $flavorId, // Instance flavor id (type: string)
            'groupId' => $groupId, // Start instance in group (type: string)
            'imageId' => $imageId, // Instance image id (type: string)
            'monthlyBilling' => $monthlyBilling, // Active monthly billing (type: boolean)
            'name' => $name, // Instance name (type: string)
            'networks' => $networks, // Create network interfaces (type: cloud.instance.NetworkParams[])
            'number' => $number, // Number of instances you want to create (type: long)
            'region' => $region, // Instance region (type: string)
            'sshKeyId' => $sshKeyIdId, // SSH keypair id (type: string)
            'userData' => $userData,// Configuration information or scripts to use upon launch (type: text)
            'volumeId' => $volumeId// Specify a volume id to boot from it (type: string)
        ));
        return $result;
    }
    
    /**
     * Get the detail of a group
     * @param string $region
     * @return type
     */
    public function getTheDetailOfAGroup(string $region = null)
    {
        $result = $this->ovh->get('/cloud/project/'.$this->project_id.'/instance/group', array(
            'region' => $region, // Instance region (type: string)
        ));
        
        return $result;
    }
    
    public function createAGroup($name = null, $region = null, $type = null)
    {
        $result = $this->ovh->post('/cloud/project/'.$this->project_id.'/instance/group', array(
            'name' => $name, // instance group name (type: string)
            'region' => $region, // Instance region (type: string)
            'type' => $type, // Instance group type (type: cloud.instancegroup.InstanceGroupTypeEnum)
        ));
        return $result;
    }
    
    public function deleteAnInstance($instanceId)
    {
        $result = $this->ovh->delete('/cloud/project/'.$this->project_id.'/instance/'.$instanceId);
        return $result;
    }
    
    public function alterAnInstance($instanceId)
    {
        $result = $ovh->put('/cloud/project/'.$this->project_id.'/instance/'.$instanceId);
        return $result;
    }
    
    public function activeMonthlyBillingOnInstance($instanceId)
    {
        $result = $this->ovh->post('/cloud/project/'.$this->project_id.'/instance/'.$instanceId.'/activeMonthlyBilling');
        return $result;
    }
    
    public function getInterfaces($instanceId)
    {
        $result = $this->ovh->get('/cloud/project/'.$this->project_id.'/instance/'.$instanceId.'/interface');
    
        return $result;
    }
    
    /**
     * Create interface on an instance and attached it to a network
     * @param type $instanceId
     * @param type $ip
     * @param string $networkId
     */
    public function postInstanceInterface($instanceId, $ip = null, string $networkId = null)
    {
        $result = $this->ovh->post('/cloud/project/'.$this->project_id.'/instance/'.$instanceId.'/interface', array(
            'ip' => $ip, // Static ip (Can only be defined for private networks) (type: ip)
            'networkId' => $networkId, // Network id (type: string)
        ));
        return $result;
    }

    /**
     * Delete an interface
     * @param type $instanceId
     * @param type $interfaceId
     * @return type
     */
    public function deleteInstanceInterface($instanceId, $interfaceId)
    {
        $result = $this->ovh->delete('/cloud/project/'.$this->project_id.'/instance/'.$instanceId.'/interface/'.$interfaceId);
        return $result;
    }

    /**
     * Get interface
     * @param type $instanceId
     * @param type $interfaceId
     * @return type
     */
    public function getInstanceInterface($instanceId, $interfaceId)
    {
        $result = $this->ovh->get('/cloud/project/'.$this->project_id.'/instance/'.$instanceId.'/interface/'.$interfaceId);
        return $result;
    }
    
    /**
     * Return many statistics about the virtual machine for a given period
     * @param type $insanceId
     * @param type $period
     * @param type $type
     * @return type
     */
    public function getInstanceMonitoring($insanceId, $period = null, $type = null)
    {
        $result = $this->ovh->get('/cloud/project/'.$this->project_id.'/instance/'.$insanceId.'/monitoring', array(
            'period' => $period, // The period the statistics are fetched for (type: cloud.instance.MetricsPeriod)
            'type' => $type, // The type of statistic to be fetched (type: cloud.instance.MetricsType)
        ));
        return $result;
    }
    
    /**
     * get all private networks
     * @return type
     */
    public function getPrivateNetworks()
    {
        $result = $this->ovh->get('/cloud/project/'.$this->project_id.'/network/private');
        return $result;
    }
    
    /**
     * get a provate network
     * @param type $networkId
     * @return array
     */
    public function getPrivateNetwork($networkId)
    {
        $result = $this->ovh->get('/cloud/project/'.$this->project_id.'/network/private/'.$networkId);    
        return $result;
    }

    public function postInstaceReboot(string $instanceId,string $type = NULL)
    {
        if ($type == 'soft' || $type == 'hard' | $type == null) {
            $result = $this->ovh->post('/cloud/project/'.$this->project_id.'/instance/'.$instanceId.'/reboot', 
                    array(
                        'type' => $type, // Reboot type (default soft) (type: cloud.instance.RebootTypeEnum)
                    ));
        } else {
            throw new \Exception('invalid parameter type');
        }
        
        return $result;
    }
    
    /**
     * Reinstall an instance
     * @param type $instanceId
     * @param string $imageId
     * @return type
     */
    public function postInstaceReinstall(string $instanceId, string $imageId)
    {
        $result = $this->ovh->post('/cloud/project/'.$this->project_id.'/instance/'.$instanceId.'/reinstall', array(
            'imageId' => $imageId , // Image to reinstall (type: string)
        ));
        
        return $result ;
    }
    
    /**
     * Enable or disable rescue mode
     * @param string $instanceId
     * @param string $imageId
     * @param bool $rescue
     * @return array
     */
    public function postInstaceRescueMode(string $instanceId, string $imageId, bool $rescue = true)
    {
        $result = $this->ovh->post('/cloud/project/'.$this->project_id.'/instance/'.$instanceId.'/rescueMode', array(
            'imageId' => $imageId, // Image to boot on (type: string)
            'rescue' => $rescue, // Enable rescue mode (type: boolean)
        ));
        return $result;
    }    
    
    /**
     * Migrate your instance to another flavor
     * @param type $instanceId
     * @param type $flavorId
     * @return array
     */
    public function postInstaceResize($instanceId, $flavorId)
    {
        $result = $this->ovh->post('/cloud/project/'.$this->project_id.'/instance/'.$instanceId.'/resize', array(
            'flavorId' => $flavorId, // Flavor id (type: string)
        ));
        
        return $result;
    }
    
    /**
     * Resume a suspended instance
     * @param type $instanceId
     * @return array
     */
    public function postInstaceResume($instanceId){
        $result = $this->ovh->post('/cloud/project/'.$this->project_id.'/instance/'.$instanceId.'/resume');
        return $result;
    }
    
    /**
     * Snapshot an instance
     * @param type $instanceId
     * @param type $snapshotName
     */
    public function postInstaceSnapshot($instanceId, $snapshotName = NULL)
    {
        $result = $this->ovh->post('/cloud/project/'.$this->project_id.'/instance/'.$instanceId.'/snapshot', array(
            'snapshotName' => $snapshotName, // Snapshot name (type: string)
        ));
    }
    
    /**
     * Get VNC access to your instance
     * @param type $instanceId
     * @return array
     */
    public function postInstacevnc($instanceId)
    {
        $result = $this->ovh->post('/cloud/project/'.$this->project_id.'/instance/'.$instanceId.'/vnc');
        return $result;
    }
}
