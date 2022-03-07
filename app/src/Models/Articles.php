<?php
namespace App\Models;

class Articles extends \Illuminate\Database\Eloquent\Model
{
    const PER_PAGE = 3;
    const UPDATED_AT = 'updated';
    const CREATED_AT = 'created';
    protected $table = 'articles';
    protected $fillable = ['title', 'content', 'summary', 'image', 'authorId'];
    
    protected $attributes = [
        'image' => ''
    ];

    /**
     * Select Database.
     * @param int $offset
     * @param int $authorId
     */
    public function getArticles($offset, $authorId) {
        $where = $authorId ? (' WHERE authorId = ' . $_SESSION['id']) : '';
        $sql = 'SELECT * FROM articles a' . $where . ' ORDER BY created DESC LIMIT ' . $offset . ', ' . SELF::PER_PAGE;

        return $this->getConnection()->select($sql);
    }

    /**
     * Count Articles.
     * @param int $authorId
     */
    public function countArticles($authorId) {
        $where = $authorId ? (' WHERE authorId = ' . $_SESSION['id']) : '';
        $sql = 'SELECT COUNT(*) as count FROM articles a' . $where;

        $result = $this->getConnection()->select($sql);
        return $result[0]->count;
    }
}
