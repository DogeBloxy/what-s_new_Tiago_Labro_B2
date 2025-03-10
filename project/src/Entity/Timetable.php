<?php

namespace App\Entity;

use App\Repository\TimetableRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: TimetableRepository::class)]
#[Vich\Uploadable]
class Timetable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $subject_morning = null;

    #[ORM\Column(length: 255)]
    private ?string $professor_morning = null;

    #[ORM\Column(length: 255)]
    private ?string $subject_afternoon = null;

    #[ORM\Column(length: 255)]
    private ?string $professor_afternoon = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $day_timetable = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSubjectMorning(): ?string
    {
        return $this->subject_morning;
    }

    public function setSubjectMorning(string $subject_morning): static
    {
        $this->subject_morning = $subject_morning;

        return $this;
    }

    public function getProfessorMorning(): ?string
    {
        return $this->professor_morning;
    }

    public function setProfessorMorning(string $professor_morning): static
    {
        $this->professor_morning = $professor_morning;

        return $this;
    }

    public function getSubjectAfternoon(): ?string
    {
        return $this->subject_afternoon;
    }

    public function setSubjectAfternoon(string $subject_afternoon): static
    {
        $this->subject_afternoon = $subject_afternoon;

        return $this;
    }

    public function getProfessorAfternoon(): ?string
    {
        return $this->professor_afternoon;
    }

    public function setProfessorAfternoon(string $professor_afternoon): static
    {
        $this->professor_afternoon = $professor_afternoon;

        return $this;
    }

    public function getDayTimetable(): ?\DateTimeInterface
    {
        return $this->day_timetable;
    }

    public function setDayTimetable(\DateTimeInterface $day_timetable): static
    {
        $this->day_timetable = $day_timetable;

        return $this;
    }
}
