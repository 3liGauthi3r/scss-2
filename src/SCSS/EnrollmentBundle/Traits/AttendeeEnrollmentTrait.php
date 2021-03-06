<?php
namespace SCSS\EnrollmentBundle\Traits;

trait AttendeeEnrollmentTrait
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\PasselBundle\Entity\Attendee", inversedBy="attendee_enrollment")
     * @ORM\JoinColumn(name="attendee_id", referencedColumnName="id")
     */
    protected $attendee;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\CourseBundle\Entity\SCSSClass", inversedBy="attendee_enrollment")
     * @ORM\JoinColumn(name="class_id", referencedColumnName="id")
     */
    protected $class;

    /**
     * Set attendee
     *
     * @param  SCSS\PasselBundle\Entity\Attendee $attendee
     * @return AttendeeEnrollment
     */
    public function setAttendee(\SCSS\PasselBundle\Entity\Attendee $attendee = null)
    {
        $this->attendee = $attendee;

        return $this;
    }

    /**
     * Get attendee
     *
     * @return SCSS\PasselBundle\Entity\Attendee
     */
    public function getAttendee()
    {
        return $this->attendee;
    }

    /**
     * Set class
     *
     * @param  SCSS\CourseBundle\Entity\Class $class
     * @return AttendeeEnrollment
     */
    public function setClass(\SCSS\CourseBundle\Entity\Class $class = null)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return SCSS\CourseBundle\Entity\Class
     */
    public function getClass()
    {
        return $this->class;
    }
}
