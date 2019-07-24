<?php

namespace Kanboard\Plugin\Greenwing;

use Kanboard\Model\TaskCreationModel as BaseTaskCreationModel;
use Kanboard\Model\TaskModel;
use Kanboard\Core\Base;

class TaskCreationModel extends BaseTaskCreationModel
{
    /**
     * Create a task
     *
     * @access public
     * @param  array    $values   Form values
     * @return integer
     */
    public function create(array $values)
    {
        $position = empty($values['position']) ? 1 : $values['position'];
        $tags = array();

        if (isset($values['tags'])) {
            $tags = $values['tags'];
            unset($values['tags']);
        }

        $this->prepare($values);
        $task_id = $this->db->table(TaskModel::TABLE)->persist($values);

        if ($task_id !== false) {
            if ($position > 0 && $values['position'] > 1) {
                $this->taskPositionModel->movePosition($values['project_id'], $task_id, $values['column_id'], $position, $values['swimlane_id'], false);
            }

            if (! empty($tags)) {
                $this->taskTagModel->save($values['project_id'], $task_id, $tags);
            }

            $this->queueManager->push($this->taskEventJob->withParams(
                $task_id,
                array(TaskModel::EVENT_CREATE_UPDATE, TaskModel::EVENT_CREATE)
            ));
        }

        $this->hook->reference('model:task:creation:aftersave', $task_id);

        return (int) $task_id;
    }
}
