<?php

namespace App\Services;



use App\Models\Appointment;
use App\Models\Meet;

class Checker
{
    /**
     * Check meet for user
     *
     * @param  int  $idDoc
     * @param  int  $date
     * @param  int  $idUser
     * @return bool
     */
    public function checkMeetForUser($idUser, $date, $idDoc):bool {
        $meet = Meet::where([
            ['date','=',$date],
            ['id_doc','=',$idDoc],
            ['id_user','=',$idUser]
        ])->exists();
        return $meet;
    }
    /**
     * Check appointment for doctor
     *
     * @param  int  $idDoc
     * @param  int  $date
     * @return bool
     */
    public function checkAppointmentForDoctor($idDoc,$date):bool {
        $appontment = Appointment::where([
            ['date','=',$date],
            ['doc_id','=',$idDoc]
        ])->exists();
        return $appontment;
    }
}
