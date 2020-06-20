<?php

use Illuminate\Database\Seeder;
use App\Specialization;

class SpecializationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Specialization::create([
        	"name"=>"Allergist",
        	"slug"=>str_slug("Allergist")
        ]);
        Specialization::create([
        	"name"=>"Anaesthesiologist",
        	"slug"=>str_slug("Anaesthesiologist")
        ]);
        Specialization::create([
        	"name"=>"Andrologist",
        	"slug"=>str_slug("Andrologist")
        ]);
        Specialization::create([
        	"name"=>"Cardiologist",
        	"slug"=>str_slug("Cardiologist")
        ]);
        Specialization::create([
        	"name"=>"Cardiac Electrophysiologist",
        	"slug"=>str_slug("Cardiac Electrophysiologist")
        ]);
        Specialization::create([
        	"name"=>"Dermatologist",
        	"slug"=>str_slug("Dermatologist")
        ]);
        Specialization::create([
        	"name"=>"Emergency Doctors",
        	"slug"=>str_slug("Emergency Doctors")
        ]);
        Specialization::create([
        	"name"=>"Endocrinologist",
        	"slug"=>str_slug("Endocrinologist")
        ]);
        Specialization::create([
        	"name"=>"Epidemiologist",
        	"slug"=>str_slug("Epidemiologist")
        ]);
        Specialization::create([
        	"name"=>"Family Medicine Physician",
        	"slug"=>str_slug("Family Medicine Physician")
        ]);
        Specialization::create([
        	"name"=>"Gastroenterologist",
        	"slug"=>str_slug("Gastroenterologist")
        ]);
        Specialization::create([
        	"name"=>"Geriatrician",
        	"slug"=>str_slug("Geriatrician")
        ]);
        Specialization::create([
        	"name"=>"Hyperbaric Physician",
        	"slug"=>str_slug("Hyperbaric Physician")
        ]);
        Specialization::create([
        	"name"=>"Hematologist",
        	"slug"=>str_slug("Hematologist")
        ]);
        Specialization::create([
        	"name"=>"Hepatologist",
        	"slug"=>str_slug("Hepatologist")
        ]);
        Specialization::create([
        	"name"=>"Immunologist",
        	"slug"=>str_slug("Immunologist")
        ]);
        Specialization::create([
        	"name"=>"Infectious Disease Specialist",
        	"slug"=>str_slug("Infectious Disease Specialist")
        ]);
        Specialization::create([
        	"name"=>"Intensivist",
        	"slug"=>str_slug("Intensivist")
        ]);
        Specialization::create([
        	"name"=>"Internal Medicine Specialist",
        	"slug"=>str_slug("Internal Medicine Specialist")
        ]);
        Specialization::create([
        	"name"=>"Maxillofacial Surgeon / Oral Surgeon",
        	"slug"=>str_slug("Maxillofacial Surgeon / Oral Surgeon")
        ]);
        Specialization::create([
        	"name"=>"Medical Geneticist",
        	"slug"=>str_slug("Medical Geneticist")
        ]);
        Specialization::create([
        	"name"=>"Neonatologist",
        	"slug"=>str_slug("Neonatologist")
        ]);
        Specialization::create([
        	"name"=>"Nephrologist",
        	"slug"=>str_slug("Nephrologist")
        ]);
        Specialization::create([
        	"name"=>"Neurologist",
        	"slug"=>str_slug("Neurologist")
        ]);
        Specialization::create([
        	"name"=>"Neurosurgeon",
        	"slug"=>str_slug("Neurosurgeon")
        ]);
        Specialization::create([
        	"name"=>"Nuclear Medicine Specialist",
        	"slug"=>str_slug("Nuclear Medicine Specialist")
        ]);
        Specialization::create([
        	"name"=>"Occupational Medicine Specialist",
        	"slug"=>str_slug("Occupational Medicine Specialist")
        ]);
        Specialization::create([
        	"name"=>"Oncologist",
        	"slug"=>str_slug("Oncologist")
        ]);
        Specialization::create([
        	"name"=>"Ophthalmologist",
        	"slug"=>str_slug("Ophthalmologist")
        ]);
        Specialization::create([
        	"name"=>"Orthopedic Surgeon / Orthopedist",
        	"slug"=>str_slug("Orthopedic Surgeon / Orthopedist")
        ]);
        Specialization::create([
        	"name"=>"Otolaryngologist",
        	"slug"=>str_slug("Otolaryngologist")
        ]);
        

    }
}
