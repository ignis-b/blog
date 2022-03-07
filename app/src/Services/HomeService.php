<?php
namespace App\Services;

use App\Models\Articles;
use App\Models\Users;

class HomeService
{
    const PER_PAGE = 3;
    const DEFAULT_IMG = 'default.jpg';
    /**
     * Count Articles.
     * @param int|string $authorId
     * @return int
     */
    public function countArticles($authorId = '')
    {
        // Get results by Model Articles.
        $articles = new Articles();
        return $articles->countArticles($authorId);
    }
    /**
     * Select Database.
     * @param int $page
     * @param int|string $authorId
     * @return array
     */
    public function selectDatabase($page, $authorId = '')
    {
        // Get results by Model Articles.
        $articles = new Articles();
        $results = $articles->getArticles($page, $authorId);

        if (empty($results)) {
            return [];
        }
        $res = [];
        foreach ($results as $result) {
            $res[$result->id]['id'] = $result->id;
            $res[$result->id]['title'] = $result->title;
            $res[$result->id]['image'] = !empty($result->image) ? $result->image : SELF::DEFAULT_IMG;
            $res[$result->id]['date'] = date('d/m/Y H:i', strtotime($result->created));
            $res[$result->id]['summary'] = $result->summary;
            $query = Users::where("id", $result->authorId);
            $res[$result->id]['author'] = $query->first()->FullName;
        }

        return $res;
    }
}
