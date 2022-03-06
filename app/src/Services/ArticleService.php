<?php
namespace App\Services;

use App\Models\Articles;

class ArticleService
{
    /**
     * Select Database.
     * @param int $article_id
     * @return array
     */
    public function selectDatabase($article_id)
    {
        $query = Articles::where("id", $article_id);
        $res = [];
        if ($query->first()->id) {
            $res['id'] = $query->first()->id;
            $res['title'] = $query->first()->title;
            $res['image'] = !empty($query->first()->image) ? $query->first()->image : HomeService::DEFAULT_IMG;
            $res['date'] = date('d/m/Y H:i', strtotime($query->first()->created));
            $res['summary'] = $query->first()->summary;
            $res['content'] = $query->first()->content;
        }
        
        return $res;
    }
    /**
     * Update in Database.
     * @param array $input
     * @return boolean
     */
    public function updateDatabase($input)
    {
        try {
            Articles::where('id', $input['id'])
                ->update([
                    'title' => $input['title'],
                    'summary' => $input['summary'],
                    'content' => $input['content'],
                    'image' => $input['image'],
            ]);

            return TRUE;
        } catch ( \Exception $e ) {
            return FALSE;
        }
    }
    /**
     * Select Database.
     * @param int $article_id
     * @return boolean
     */
    public function deleteDatabase($article_id)
    {
        try {
            Articles::where('id', $article_id)
                ->delete();

            return TRUE;
        } catch ( \Exception $e ) {
            return FALSE;
        }
    }
}
