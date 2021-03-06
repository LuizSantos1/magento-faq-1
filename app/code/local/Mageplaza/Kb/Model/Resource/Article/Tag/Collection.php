<?php
/**
 * Mageplaza_Kb extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Mageplaza
 * @package        Mageplaza_Kb
 * @copyright      Copyright (c) 2015
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Article - Tag relation resource model collection
 *
 * @category    Mageplaza
 * @package     Mageplaza_Kb
 * @author
 */
class Mageplaza_Kb_Model_Resource_Article_Tag_Collection extends Mageplaza_Kb_Model_Resource_Tag_Collection
{
    /**
     * remember if fields have been joined
     * @var bool
     */
    protected $_joinedFields = false;

    /**
     * join the link table
     *
     * @access public
     * @return Mageplaza_Kb_Model_Resource_Article_Tag_Collection
     * @author
     */
    public function joinFields()
    {
        if (!$this->_joinedFields) {
            $this->getSelect()->join(
                array('related' => $this->getTable('mageplaza_kb/article_tag')),
                'related.tag_id = main_table.entity_id',
                array('position')
            );
            $this->_joinedFields = true;
        }
        return $this;
    }

    /**
     * add article filter
     *
     * @access public
     * @param Mageplaza_Kb_Model_Article | int $article
     * @return Mageplaza_Kb_Model_Resource_Article_Tag_Collection
     * @author
     */
    public function addArticleFilter($article)
    {
        if ($article instanceof Mageplaza_Kb_Model_Article) {
            $article = $article->getId();
        }
        if (!$this->_joinedFields) {
            $this->joinFields();
        }
        $this->getSelect()->where('related.article_id = ?', $article);
        return $this;
    }
}
