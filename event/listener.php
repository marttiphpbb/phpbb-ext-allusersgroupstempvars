<?php
/**
* phpBB Extension - marttiphpbb allusersgroupstempvars
* @copyright (c) 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\allusersgroupstempvars\event;

use phpbb\event\data as event;
use phpbb\db\driver\factory as db;
use phpbb\user;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/* @var db */
	protected $db;

	/* @var user */
	protected $user;

	/* @var array */
	private $user_ids = [];

	/**
	 * @param db $db
	 * @param user $user
	*/
	public function __construct(
		db $db,
		string $user_group_table
	)
	{
		$this->db = $db;
		$this->user_group_table = $user_group_table;
	}

	static public function getSubscribedEvents()
	{
		return [
			'core.ucp_pm_view_message'
				=> 'core_ucp_pm_view_message',
			'core.viewtopic_cache_user_data'
				=> 'core_viewtopic_cache_user_data',
			'core.mcp_topic_review_modify_row'
				=> 'core_mcp_topic_review_modify_row',
			'core.memberlist_prepare_profile_data'
				=> 'core_memberlist_prepare_profile_data',
			'core.search_modify_tpl_ary'
				=> 'core_search_modify_tpl_ary',
			'core.twig_environment_render_template_before'
				=> 'core_twig_environment_render_template_before',
		];
	}

	public function core_ucp_pm_view_message(event $event)
	{
		$message_row = $event['message_row'];
		$msg_data = $event['msg_data'];
	
		$author_id = $message_row['author_id']; 
		$this->user_ids[$author_id] = true;
		$msg_data['AUTHOR_ID'] = $author_id;

		$event['msg_data'] = $msg_data;
	}

	public function core_search_modify_tpl_ary(event $event)
	{
		$show_results = $event['show_results'];

		if ($show_results === 'topics')
		{
			return;
		}

		$row = $event['row'];
		$tpl_ary = $event['tpl_ary'];

		$poster_id = $row['poster_id'];
		$this->user_ids[$poster_id] = true;	
		$tpl_ary['POSTER_ID'] = $poster_id;

		$event['tpl_ary'] = $tpl_ary;
	}

	public function core_memberlist_prepare_profile_data(event $event)
	{
		$data = $event['data'];
		$template_data = $event['template_data'];

		$user_id = $data['user_id'];
		$this->user_ids[$user_id] = true;
		$template_data['USER_ID'] = $user_id;

		$event['template_data'] = $template_data;
	}

	public function core_mcp_topic_review_modify_row(event $event)
	{
		$row = $event['row'];
		$post_row = $event['post_row'];
		$poster_id = $row['poster_id'];

		$this->user_ids[$poster_id] = true;

		$post_row['POSTER_ID'] = $poster_id;
		$event['post_row'] = $post_row;
	}

	public function core_viewtopic_cache_user_data(event $event)
	{
		$poster_id = $event['poster_id'];
		$this->user_ids[$poster_id] = true;
	}

	public function core_twig_environment_render_template_before(event $event)
	{
		if (!count($this->user_ids))
		{
			return;
		}
	
		$context = $event['context'];
		$tpl_vars = [];
		$user_ids = array_keys($this->user_ids);

		$sql = 'select user_id, group_id
			from ' . $this->user_group_table . '
			where ' . $this->db->sql_in_set('user_id', $user_ids) . '
				and user_pending = 0';
	
		$result = $this->db->sql_query($sql);
	
		while ($row = $this->db->sql_fetchrow($result))
		{
			$tpl_vars[$row['user_id']][$row['group_id']] = true;
		}
	
		$this->db->sql_freeresult($result);

		$context['marttiphpbb_allusersgroupstempvars'] = $tpl_vars;
		$event['context'] = $context;
	}
}
