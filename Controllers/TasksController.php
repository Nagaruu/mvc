<?php

namespace mvc\Controllers;

use mvc\Models\TaskModel;
use mvc\Core\Controller;
use mvc\Models\TaskRepository;

class TasksController extends Controller
{
    function index()
    {
        $tasks = new TaskRepository();

        $d['tasks'] = $tasks->getAll();
        $this->set($d);
        $this->render("index");
    }

    function create()
    {
        if (isset($_POST["title"]))
        {
            $task = new TaskRepository();

            $taskmodel = new TaskModel;
            $taskmodel->setTitle($_POST["title"]);
            $taskmodel->setDescription($_POST["description"]);
            if ($task->add($taskmodel))

            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }

        $this->render("create");
    }

    function edit($id)
    {
        $task = new TaskRepository();

        $d["task"] = $task->get($id);

        if (isset($_POST["title"]))
        {
            $taskmodel = new TaskModel;
            $taskmodel->setId($id);
            $taskmodel->setTitle($_POST["title"]);
            $taskmodel->setDescription($_POST["description"]);

            if ($task->edit($taskmodel))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        $task = new TaskRepository();
        $taskmodel = new TaskModel;
        $taskmodel->setId($id); 
        if ($task->delete($taskmodel))
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}
?>