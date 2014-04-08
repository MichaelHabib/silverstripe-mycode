<?php

/**
 * Create Demo Pages & Objects .
 * 
 * Description:
 * 	+ Create Demo Pages & pupulate with $defaults .
 * 	+ Input fields & label can be set using an array
 * 
 */
class RealEstate_CreateDemoData extends BuildTask {

    protected $title = 'RealEstate_CreateDemoData';
    protected $description = 'Auto create Demo data for the RealEstate Project.';
    protected $enabled = true;

    function run($request) {

        echo $this->create_link('?do=CreateBranchData', 'CreateBranchData', '_new');
        echo '-------------------<br/>';
        echo $this->create_link('?do=CreateBranch', 'Create Branchs', '_new');
        echo $this->create_link('?do=CreateManager', 'CreateManager', '_new');
        echo $this->create_link('?do=CreateEmployees', 'CreateEmployees', '_new');
        echo '-------------------<br/>';
        echo $this->create_link('?do=RemoveAllData', 'RemoveAllData', '_new');
        echo $this->create_link('?do=DropTables', 'DropTables', '_new');


        if ($_GET && isset($_GET['do'])) {
            $do = $_GET['do'];


            //**********************************************	
            if ($do == 'CreateBranchData') {
                echo '##########<br/>';
                $Branch = $this->create_Branch();
                $this->create_Person('Manager', array('
                    BranchID' => $Branch->ID
                ));
                $this->create_Persons(5, 'Staff', array(
                    'BranchID' => $Branch->ID
                ));
                $this->create_Persons(5, 'Supervisor', array(
                    'BranchID' => $Branch->ID,
                ));
                $this->create_Persons(5, 'Secretary', array(
                    'BranchID' => $Branch->ID,
                ));
                $Renters = $this->create_Persons(5, 'Renter', array(
                        ));
                foreach ($Renters as $key => $Renter) {
                    $object = new Inquiry();
                    $object->Title = 'Inquiry for Renter' . $Renter->ID;
                    $object->RenterID = $Renter->ID;
                }
                echo '##########<br/>';


                $this->create_Properties(5, 'PrivateProperty', array(
//                    'Name' => 'Private Property Name',
                    'BranchID' => $Branch->ID,
                ));
            }

            //**********************************************	
            if ($do == 'CreateBranch') {
                $this->create_Branch();
            }

            //**********************************************	
            if ($do == 'CreateManager') {
                $this->create_Employee('Manager');
            }
            //**********************************************	
            if ($do == 'CreateEmployees') {
                $this->create_Person('Manager', array(
                ));
                $this->create_Persons(5, 'Staff', array(
                ));
                $this->create_Persons(5, 'Supervisor', array(
                ));
                $this->create_Persons(5, 'Secretary', array(
                ));
            }

            //**********************************************	
            if ($do == 'CreateProperties') {
                $data = array(
                    'Name' => 'Private Property Name',
                );
                $this->create_Properties(5, 'PrivateProperty', $data);
                $data = array(
                    'Name' => 'Business Property Name',
                );
                $this->create_Properties(5, 'BusinessProperty', $data);
            }

            //**********************************************	
            if ($do == 'RemoveAllData') {
                $data = Branch::get();
                foreach ($data as $key => $value) {
                    $value->delete();
                }
                $data = Manager::get();
                foreach ($data as $key => $value) {
                    $value->delete();
                }
                $data = Supervisor::get();
                foreach ($data as $key => $value) {
                    $value->delete();
                }
                $data = Staff::get();
                foreach ($data as $key => $value) {
                    $value->delete();
                }
                $data = Secretary::get();
                foreach ($data as $key => $value) {
                    $value->delete();
                }
                //**********************************************	
                $data = PrivateProperty::get();
                foreach ($data as $key => $value) {
                    $value->delete();
                }
                $data = BusinessProperty::get();
                foreach ($data as $key => $value) {
                    $value->delete();
                }
                //**********************************************	

                $data = Renter::get();
                foreach ($data as $key => $value) {
                    $value->delete();
                }
                $data = Inquiry::get();
                foreach ($data as $key => $value) {
                    $value->delete();
                }
                $data = Interview::get();
                foreach ($data as $key => $value) {
                    $value->delete();
                }
                //**********************************************	
                $data = Lease::get();
                foreach ($data as $key => $value) {
                    $value->delete();
                }
                $data = LeaseRenew::get();
                foreach ($data as $key => $value) {
                    $value->delete();
                }
            }

            //**********************************************	
            if ($do == 'DropTables') {
                $tables = array(
                    'Branch',
                    'Employee',
                    'Manager',
                    'Supervisor',
                    'Secretary',
                    'Staff',
                    'Renter',
                    'Property',
                    'PrivateProperty',
                    'BusinessProperty',
                    'Lease',
                );
                foreach ($tables as $key => $table) {
                    DB::query("DROP TABLE IF EXISTS \"$table\"");
                }
            }
        }

    }

// End run()

    public function create_Branch() {
        $ClassName = 'Branch';
        $object = new $ClassName;
        $object->Write();
        $object->Name = $ClassName . $object->ID;
        $object->Write();
        DB::alteration_message("$ClassName created. ID = $object->ID , Name = $object->Name", "created");

        return $object;

    }

    public function create_Property($ClassName = 'Property', $data = array()) {

        $object = new $ClassName();
        if ($data) {
            foreach ($data as $key => $value) {
                $object->{$key} = $value;
            }
        }
        $object->write();
        if (!isset($data['Name'])) {
            $object->Name = $object->ClassName . $object->ID;
        }
        $object->write();
        DB::alteration_message("$ClassName created. ID = $object->ID ", "created");

        return $object;

    }

    public function create_Properties($count, $ClassName = 'Property', $data = array()) {
        $Objects = array();
        for ($i = 0; $i < $count; $i++) {
            $Objects[] = $this->create_Property($ClassName, $data);
        }
        return $Objects;

    }

    public function create_Person($ClassName, $data = array()) {
        $Domain = Helper::getCleanDomain();
        $PermisstionCodes = array('administrators');
        $Groups = Group::get()->filter(array('Code' => $PermisstionCodes));
//        $Groups = Group::get();
//        debug::dump($Groups);
//        foreach ($Groups as $key => $Group) {
//            debug::dump($Group);
//        }
//        debug::dump('XXXXXX');

        $object = new $ClassName();
        $object->FirstName = $ClassName;
        $object->Email = substr("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", mt_rand(0, 50), 1) . substr(md5(time()), 1) . '@' . $Domain;
        $object->Password = $ClassName;
        $object->write();
        foreach ($Groups as $Group) {
            $object->Groups()->add($Group->ID);
        }

        // Update Details
        if (!isset($data['Name'])) {
            $object->FirstName = $object->ClassName . $object->ID;
        }

        $object->Email = $ClassName . $object->ID . '@' . $Domain;
        if ($data) {
            foreach ($data as $key => $value) {
                $object->{$key} = $value;
            }
        }
        $object->write();
        $Email = $object->Email;
        DB::alteration_message("$ClassName created. ID = $object->ID , FirstName = $object->FirstName , Email = $Email", "created");

        return $object;

    }

    public function create_Persons($count, $ClassName, $data = array()) {
        $Persons = array();
        for ($i = 0; $i < $count; $i++) {
            $Persons[] = $this->create_Person($ClassName, $data);
        }
        return $Persons;

    }

    public function create_link($link, $text = null, $target = null) {
        if (!$text) {
            $text = $link;
        }
        if (!$target) {
            $target = '_self';
        }
        return "<a href=\"$link\" target=\"$target\"> $text </a> <br/>";

    }

}