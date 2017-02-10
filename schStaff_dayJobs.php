<?php

class dayJobs {

    var $dayName;
    var $day ;
    var $month; 
    var $year;
    var $date;

//------------------------------CONSTRUCTOR---------------------------------
    function dayJobs ($dayName, $day, $month, $year) {

        $this->dayName = $dayName;

        $this->day = $day;
        $this->month = $month;
        $this->year = $year;

        $this->date = $day.'-'.$month.'-'.$year;
    }
//---------------------------------------------------------------------------

//----------------------------SHOW CALENDAR----------------------------------
    function showCalendar () {
        $Output = "";
        //$Output .= $this->buttonsWeek ($this->dia, $this->mes, $this->ano, $this->date["numDiasMes"]);
        //$Output .= $this->buttons ($this->dia, $this->mes, $this->ano, $this->date["numDiasMes"]);
        $Output .= "<div id='calBox' border='3' width='100%' class='dayJobsBox'>";
        $Output .= $this->dayTable 
                    ($this->dayName, $this->day, $this->month, $this->year);
        $Output .= "</div>";
        return $Output;
    }
//--------------------------------------------------------------------------- 

 //------------------------WEEK TABLE FUNCTION----------------------------       
   function dayTable ( $dayName, $dia, $mes, $ano) {
        $Output ="<div>";
            $Output .= '<span class="dayJobsBox">
                                <br> <b>'.$dayName.' : ('.$this->date.')</b> <br>
                            </span> 
                        ';

            $jobs= $this->CallStocktakes ($dia, $mes, $ano);


        //Seguimos a partir del dia seleccionado
            $Output .="<span style='clear:both;'></span>";

        
        $Output .= $jobs."</div>";
        return $Output;
    }

 //-----------------------------------------------------------------------   
//---------------------Call Stocktakes------------------------------------
    function CallStocktakes ($day, $month, $year) {
            
            require ("db_connect.php");

            if ($day<10){
                switch ($day) {
                    case 1: $day="01"; break;
                    case 2: $day="02"; break;
                    case 3: $day="03"; break;
                    case 4: $day="04"; break;
                    case 5: $day="05"; break;
                    case 6: $day="06"; break;
                    case 7: $day="07"; break;
                    case 8: $day="08"; break;
                    case 9: $day="09"; break;
                }
            }
            if ($month<10){
                switch ($month) {
                    case 1: $month="01"; break;
                    case 2: $month="02"; break;
                    case 3: $month="03"; break;
                    case 4: $month="04"; break;
                    case 5: $month="05"; break;
                    case 6: $month="06"; break;
                    case 7: $month="07"; break;
                    case 8: $month="08"; break;
                    case 9: $month="09"; break;
                }
            }
            $fullDate =$year."-".$month."-".$day;

            $job_staff="";
            $assigned_staff="";
            $supervisor="";
            $counter=0;

            $sql = "SELECT 
                            idStocktake,status,date,Store_id, Supervisor_Staff_id,
                            name,idStore,addressLine1,addressLine2,County,Region
                    FROM    stocktake, store  
                    where   Store_id=idStore ;

                    ";

            $sql_2 ="SELECT 
                            name, idStaff, County,Region
                            Stocktake_id, Staff_id
                    FROM    staff , stocktake_staff   
                    where   (idStaff=Staff_id) ;

                    ";

            $result = mysqli_query($conn, $sql);
            $result_2 = mysqli_query($conn, $sql_2);

            //echo $result;
            $currentjobs="";
            if (mysqli_num_rows($result)>0) {
                 //output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    if($row["date"]==$fullDate){
                        $currentjobs.= '<div id="'. $row["idStocktake"].'" class="dayJob '.$row["status"].' '.$row["Region"].'" draggable="true" 
                                            ondragstart="drag(event)" onclick="openstocktake(this.id)">' 
                                            . $row["name"].' <br>'.$row["County"].', '.$row["Region"].'</div>';
                                            //add supervisor
                        $counter = $counter+1;
                        $sql3="SELECT Supervisor_Staff_id, ";
                        if (mysqli_num_rows($result_2)>0){
                           while($row_2 = mysqli_fetch_assoc($result_2)) {
                                if($row_2["Stocktake_id"]==$row["idStocktake"]){
                                    if($row["Supervisor_Staff_id"]==$row_2["idStaff"])
                                    {
                                        $supervisor= '<div id="x" class="btn " draggable="true" 
                                            ondragstart="drag(event)" onclick="openstocktake(this.id)"> Supervisor <br>' 
                                         . $row["staff.name"].'????</div>';
                                    }
                                    else
                                    {
                                         $assigned_staff.='<div id="'. $row_2["idStaff"].'" class="btn '.$row_2["Region"].'" draggable="true" 
                                            ondragstart="drag(event)" onclick="openstocktake(this.id)">'
                                         . $row_2["name"].' <br>'.$row_2["County"].', '.$row_2["Region"].'</div>';
                                    }
                                   
                                }
                           } 
                        }
                        $job_staff.='<div class="joblong" ondrop="drop(event)"
                         ondragover="allowDrop(event)">'.$supervisor.' '.$assigned_staff.'</div>'; 
                         $assigned_staff=""; $superviso="";
                    }
                }
            $currentjobs.="<br><br><br><span style='clear:both;'></span>";
            $currentjobs.= '<br>'.$job_staff;
            //----------------------start listing staff-------------------------------

            //----------------finish staff listing---------------------------------
            } else {
                return "0 results";
            }
                    return $currentjobs;

            mysqli_close($conn);
}
//--------------------------------------------------------------------------

}//End of Class


?>