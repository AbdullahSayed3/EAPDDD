<?php

namespace App\Jobs;

use App\Exports\ExportCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessCourseExport implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $courseIds;
    protected $view;
    public function __construct(array $courseIds, string $view)
    {
        //
        $this->courseIds = $courseIds;
        $this->view = $view;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        //
        $fileName = 'exports/courses_' . now()->format('Ymd_His') . '.xlsx';

        // Generate and store the export
        return new ExportCourse($this->courseIds, $this->view);
    }
}
