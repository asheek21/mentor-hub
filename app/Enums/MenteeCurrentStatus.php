<?php

namespace App\Enums;

enum MenteeCurrentStatus: string
{
    case HighSchoolStudent = 'high_school_student';
    case UniversityStudent = 'university_student';
    case Graduate = 'graduate';
    case EarlyCareerProfessional = 'early_career_professional';
    case MidLevelProfessional = 'mid_level_professional';
    case SeniorProfessional = 'senior_professional';
    case CareerChanger = 'career_changer';
    case Entrepreneur = 'entrepreneur';
    case Freelancer = 'freelancer';
    case BetweenJobs = 'between_jobs';
    case Other = 'other';

    public function label(): string
    {
        return match ($this) {
            self::HighSchoolStudent => 'Student (High School)',
            self::UniversityStudent => 'Student (University/College)',
            self::Graduate => 'Recent Graduate',
            self::EarlyCareerProfessional => 'Early Career Professional (0-2 years)',
            self::MidLevelProfessional => 'Mid-level Professional (3-7 years)',
            self::SeniorProfessional => 'Senior Professional (8+ years)',
            self::CareerChanger => 'Career Changer',
            self::Entrepreneur => 'Entrepreneur',
            self::Freelancer => 'Freelancer',
            self::BetweenJobs => 'Between Jobs',
            self::Other => 'Other',
        };
    }
}
