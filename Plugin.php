<?php

namespace Kanboard\Plugin\Greenwing;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base {
	public function initialize() {

		$this->template->setTemplateOverride( 'board/table_container', 'Greenwing:table_container' );
		$this->template->setTemplateOverride( 'task/details', 'Greenwing:task_details' );
		$this->template->setTemplateOverride( 'task/layout', 'Greenwing:task_layout' );
		$this->template->setTemplateOverride( 'project_header/header', 'Greenwing:project_header' );
		$this->template->setTemplateOverride( 'board/task_private', 'Greenwing:task_private' );
		$this->template->setTemplateOverride( 'board/task_public', 'Greenwing:task_public' );
		$this->template->setTemplateOverride( 'board/task_avatar', 'Greenwing:task_avatar' );
		$this->template->setTemplateOverride( 'board/task_footer', 'Greenwing:task_footer' );
		$this->template->setTemplateOverride( 'board/table_column', 'Greenwing:table_column' );
		$this->template->setTemplateOverride( 'board/table_tasks', 'Greenwing:table_tasks' );
		$this->template->setTemplateOverride( 'twofactor/check', 'Greenwing:check' );
		$this->template->setTemplateOverride( 'task/show', 'Greenwing:show' );
		$this->template->setTemplateOverride( 'project_overview/columns', 'Greenwing:columns' );
		$this->template->setTemplateOverride( 'comment/show', 'Greenwing:comment_show' );
		$this->template->setTemplateOverride( 'dashboard/projects', 'Greenwing:projects' );
		$this->template->setTemplateOverride( 'project_list/listing', 'Greenwing:projects_listing' );
		$this->template->setTemplateOverride( 'user_list/listing', 'Greenwing:users_listing' );
		$this->template->setTemplateOverride( 'group/users', 'Greenwing:group_users' );
		$this->template->setTemplateOverride( 'user_list/user_title', 'Greenwing:user_title' );
		$this->template->setTemplateOverride( 'header/user_dropdown', 'Greenwing:user_dropdown' );
		$this->template->setTemplateOverride( 'task_list/task_avatars', 'Greenwing:task_avatars' );
		$this->template->setTemplateOverride( 'user_view/profile', 'Greenwing:profile' );

		$this->container['colorModel'] = $this->container->factory( function ( $c ) {
			return new ColorModel( $c );
		} );

		$this->container['taskCreationModel'] = $this->container->factory( function ( $c ) {
			return new TaskCreationModel( $c );
		} );

		$this->helper->register( 'myTaskHelper', '\Kanboard\Plugin\Greenwing\MyTaskHelper' );
		$this->helper->register( 'myAvatarHelper', '\Kanboard\Plugin\Greenwing\MyAvatarHelper' );

		$this->setContentSecurityPolicy( array( 'font-src' => "'self' fonts.gstatic.com" ) );

		$manifest = json_decode( file_get_contents( __DIR__ . '/dist/rev-manifest.json', true ), true );

		$this->hook->on( "template:layout:css", array( "template" => "plugins/Greenwing/dist/" . $manifest['main.css'] ) );
	}

	public function getPluginName() {
		return 'Greenwing';
	}

	public function getPluginAuthor() {
		return 'Cloud Temple';
	}

	public function getPluginVersion() {
		return '1.0.0';
	}

	public function getPluginHomepage() {
		return 'https://github.com/.../...';
	}

	public function getPluginDescription() {
		return t( 'This plugin add a new stylesheet and override default styles.' );
	}
}
