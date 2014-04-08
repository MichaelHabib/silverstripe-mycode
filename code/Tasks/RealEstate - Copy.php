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

        echo $this->create_link('?do=CreateBranch');
        echo $this->create_link('?do=CreateBranchs');
        echo $this->create_link('?do=CreateEmployees');
        echo $this->create_link('?do=CreateBranchAndEmployees');

        if ($_GET && isset($_GET['do'])) {
            $do = $_GET['do'];


            if ($do == 'CreateBranch') {
                $this->create_Branch();
            }
        }




        /*
         * --------------------------------------------
         * Create Branch Data
         * --------------------------------------------
         *  */
        $ClassName = 'Branch';
        for ($i = 0; $i < 1; $i++) {
            $object = new $ClassName;
            $object->Name = $ClassName . $i;
            $object->Write();
            $BranchID = $object->ID;
            /*
             * --------------------------------------------
             * Create Member(s)/Employees
             * --------------------------------------------
             *  */
            $ClassName = 'Manager';
            $MemberEmail = $ClassName . $i . '@' . $Domain;
            $NewMember = Helper::createMember($MemberEmail, $MemberEmail, 'temppass', $addToGroups, $ClassName);
            $NewMember->Name = $ClassName . " " . $NewMember->ID;
            $NewMember->BranchID = $BranchID;
            $NewMember->write();


            $ClassName = 'Supervisor';
            for ($i = 0; $i < $RecordCount; $i++) {
                $MemberEmail = $ClassName . $i . '@' . $Domain;
                $NewMember = Helper::createMember($MemberEmail, $MemberEmail, 'temppass', $addToGroups, $ClassName);
                $NewMember->Name = $ClassName . " " . $NewMember->ID;
                $NewMember->BranchID = $BranchID;
                $NewMember->write();
            }

            $ClassName = 'Staff';
            for ($i = 0; $i < $RecordCount; $i++) {
                $MemberEmail = $ClassName . $i . '@' . $Domain;
                $NewMember = Helper::createMember($MemberEmail, $MemberEmail, 'temppass', $addToGroups, $ClassName);
                $NewMember->Name = $ClassName . " " . $NewMember->ID;
                $NewMember->BranchID = $BranchID;
                $NewMember->write();
            }

            $ClassName = 'Secretary';
            for ($i = 0; $i < $RecordCount; $i++) {
                $MemberEmail = $ClassName . $i . '@' . $Domain;
                $NewMember = Helper::createMember($MemberEmail, $MemberEmail, 'temppass', $addToGroups, $ClassName);
                $NewMember->Name = $ClassName . " " . $NewMember->ID;
                $NewMember->BranchID = $BranchID;
                $NewMember->write();
            }
        }

    }

// End run()

    public function create_Branches($count = 1) {
        $Branches = array();
        for ($i = $count; $i < 1; $i++) {
            $Branches[] = $this->create_Branch();
        }
        return $Branches;

    }

    public function create_Branch() {
        $ClassName = 'Branch';
        $object = new $ClassName;
        $object->Write();
        $object->Name = $ClassName . $object->ID;
        $object->Write();
        return $object;

    }

    public function create_Employee($ClassName = "Staff", $BranchID = null) {
        $Domain = Helper::getCleanDomain();
        $addToGroups = array('adminstrator');

        $MemberEmail = $ClassName . '@' . $Domain;
        $NewMember = Helper::createMember($MemberEmail, $MemberEmail, 'temppass', $addToGroups, $ClassName);
        $NewMember->Name = $ClassName . " " . $NewMember->ID;
        if ($BranchID) {
            $NewMember->BranchID = $BranchID;
        }
        $NewMember->write();
        return $NewMember;

    }

    public function create_Employees($count = 1, $ClassName = "Staff", $BranchID = null) {
        $Employees = array();
        for ($i = $count; $i < 1; $i++) {
            $Employees[] = $this->create_Employee($ClassName, $BranchID);
        }
        return $Employees;

    }

    public function create_BranchesEmployees() {
        
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