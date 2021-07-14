<?php

namespace App\Controller;

use App\Entity\Availablerooms;
use App\Entity\Patients;
use App\Entity\Rooms;
use App\Repository\ActivepatientsRepository;
use App\Repository\AvailableRoomsRepository;
use App\Repository\PatientsRepository;
use App\Repository\RoomsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController {
    /**
     * @Route("/", name="main")
     */
    public function index(): Response {
        return $this->render('main/index.html.twig');
    }

    /**
     * @Route("/patient-admission", name="patientAdmission")
     */
    public function patientAdmission(Request $request,PatientsRepository $patientsRepository, AvailableRoomsRepository $availableRoomsRepository, RoomsRepository $roomsRepository, ActivepatientsRepository $activepatientsRepository): Response {
        $availableRoomsIds = $availableRoomsRepository->findAll();
        $activePatientsIds = $activepatientsRepository->findAll();
        $availableRooms = [];
        $activePatients = [];

        foreach ($availableRoomsIds as $room) {
            array_push($availableRooms, $roomsRepository->findOneBy(['id' => $room->getRoomId()]));
        }

        foreach ($activePatientsIds as $patient) {
            array_push($activePatients, $patientsRepository->findOneBy(['id' => $patient->getPatientId()]));
        }
        // handle all forms with method POST
        if ($request->getMethod() === 'POST') {
            if ($request->request->has('patientInfo')) {
                return $this->createPatient($request, $roomsRepository,$availableRoomsRepository);
            }
            if ($request->request->has('addRoom')) {
                return $this->createRoom($request, $roomsRepository);
            }
        }

        //jauztaisa vēl tā, kad pievieno pacientu ar kādu jau pieejamo nummuriņu, tad tas nummuriņš paliek neaktivs, parcik vins ir aiznemts

        return $this->render('main/patientAdmission/patientAdmission.html.twig', ['activePatients' => $activePatients, 'availableRooms' => $availableRooms]);
    }

    /**
     * @Route("/rooms", name="rooms")
     */
    public function Rooms(Request $request, RoomsRepository $roomsRepository, AvailableRoomsRepository $availableRoomsRepository, PatientsRepository $patientsRepository): Response {
        $rooms = $roomsRepository->findAll();
        foreach($rooms as $room) {
            $aroom = $availableRoomsRepository->findOneBy(['roomid' => $room->getId()]);
            if ($aroom) {
                $room->available = true;
            } else {
                $room->available = false;
            }
        }

        if ($request->getMethod() === 'POST') {
            if ($request->request->has('available')) {
                $status = $this->changeAvailability($request,$roomsRepository,$availableRoomsRepository, $patientsRepository);
                if ($status === false) {
                    $this->addFlash('error', 'Patient have taken this room.');
                } else {
                    $this->addFlash('', '');
                }
            }
            return $this->redirectToRoute('rooms');
        }

        return $this->render('main/rooms/rooms.html.twig', ['rooms' => $rooms]);
    }

    /**
     * @Route("/patient-history", name="patientHistory")
     */
    public function patientHistory(): Response
    {
        return $this->render('main/patientAdmission/patientAdmission.html.twig');
    }

    private function createPatient($request,$roomsRepository, $availableRoomsRepository) {
            $name = $request->get('name');
            $contact = $request->get('contact');
            $gender = $request->get('gender');
            $father = $request->get('family') === 'true' ? true : false;
            $age = $request->get('age');
            $village = $request->get('location');
            $district = $request->get('district');
            $emergency = $request->get('emergencyId');
            $occupation = $request->get('occupation');
            $bloodgroup = $request->get('BloodGroup');
            $religion = $request->get('religion');
            $room = $request->get('room');
            $admisionfee = $request->get('admissionFee');
            $advance = $request->get('advance');
            $consultant = $request->get('consultant');
            $referredby = $request->get('referred');
            $date = $request->get('date');
            $time = date('H:i a');

            $em = $this->getDoctrine()->getManager();


            $patient = new Patients();
            $patient->setName($name);
            $patient->setContact($contact);
            $patient->setGender($gender);
            $patient->setAge($age);
            $patient->setFather($father);
            $patient->setVillage($village);
            $patient->setDistrict($district);
            $patient->setEmergency($emergency);
            $patient->setOccupation($occupation);
            $patient->setBloodgroup($bloodgroup);
            $patient->setReligion($religion);
            $patient->setRoom($room);
            $patient->setAdmisionfee($admisionfee);
            $patient->setAdvance($advance);
            $patient->setConsultant($consultant);
            $patient->setReferredby($referredby);
            $patient->setDate($date);
            $patient->setTime($time);



            $roomid = $roomsRepository->findOneBy(['Room' => $room]);
            $availableRoom = $availableRoomsRepository->findOneBy(['roomid' => $roomid]);
            $em->persist($patient);
            $em->remove($availableRoom);
            $em->flush();

            return $this->redirectToRoute('patientAdmission');
    }

    private function createRoom($request, $roomsRepository) {
        $em = $this->getDoctrine()->getManager();

        $newRoom = new Rooms();

        $roomType = $request->get('roomType');
        $room = $request->get('room');
        $roomPrice = $request->get('roomPrice');

        $newRoom->setRoom($room);
        $newRoom->setType($roomType);
        $newRoom->setPrice($roomPrice);
        $em->persist($newRoom);
        $em->flush();

        $existingRoom = $roomsRepository->findOneBy(['Room' => $room]);
        $newAvailableRoom = new Availablerooms();
        $newAvailableRoom->setRoomId($existingRoom->getId());

        $em->persist($newAvailableRoom);
        $em->flush();

        return $this->redirectToRoute('patientAdmission');

    }

    private function changeAvailability($request, $roomsRepository, $availableRoomsRepository, $patientsRepository) {
        $available = '';
        $roomid = (int)$request->get('roomid');
        $availableRoom = $availableRoomsRepository->findOneBy(['roomid' => $roomid]);

        if ($request->get('available') === 'true') {
            $available = false;
        }
        if ($request->get('available') === 'false') {
            $available = true;
        }
        $em = $this->getDoctrine()->getManager();


        if ($available) {
            $newAvailableRoom = new Availablerooms();
            $room = $roomsRepository->findOneBy(['id' => $roomid]);
            $roomName = $room->getRoom();
            $patientHasThisRoom = $patientsRepository->findOneBy(['room' => $roomName]);

            if ($patientHasThisRoom) return false;

            $newAvailableRoom->setRoomId($roomid);

            $em->persist($newAvailableRoom);
            $em->flush();
        } else {

            $em->remove($availableRoom);
            $em->flush();
        }



    }

}
