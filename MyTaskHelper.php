<?php

namespace Kanboard\Plugin\Greenwing;

use Kanboard\Core\Base;

class MyTaskHelper extends Base
{
    public function getNewBoardTaskButton(array $swimlane, array $column)
    {
        $html = '<div class="board-add-icon btn btn-blue btn-circle btn-sm">';
        $providers = $this->externalTaskManager->getProviders();

        if (empty($providers)) {
            $html .= $this->helper->modal->largeIcon(
                'plus',
                t('Add a new task'),
                'TaskCreationController',
                'show', array(
                    'project_id'  => $column['project_id'],
                    'column_id'   => $column['id'],
                    'swimlane_id' => $swimlane['id'],
                )
            );
        } else {
            $html .= '<div class="dropdown">';
            $html .= '<a href="#" class="dropdown-menu"><i class="fa fa-plus" aria-hidden="true"></i></a><ul>';

            $link = $this->helper->modal->large(
                'plus',
                t('Add a new Kanboard task'),
                'TaskCreationController',
                'show', array(
                    'project_id'  => $column['project_id'],
                    'column_id'   => $column['id'],
                    'swimlane_id' => $swimlane['id'],
                )
            );

            $html .= '<li>'.$link.'</li>';

            foreach ($providers as $provider) {
                $link = $this->helper->url->link(
                    $provider->getMenuAddLabel(),
                    'ExternalTaskCreationController',
                    'step1',
                    array('project_id' => $column['project_id'], 'swimlane_id' => $swimlane['id'], 'column_id' => $column['id'], 'provider_name' => $provider->getName()),
                    false,
                    'js-modal-large'
                );

                $html .= '<li>'.$provider->getIcon().' '.$link.'</li>';
            }

            $html .= '</ul></div>';
        }

        $html .= '</div>';

        return $html;
    }
}