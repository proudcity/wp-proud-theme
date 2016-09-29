<!-- 
@todo: we are currently linking to the previous answer because the topnav takes up 50px.  
We should revisit this when we figure it out: https://github.com/proudcity/wp-proudcity/issues/576.
-->
<a name="answer-list-legend"></a>
<ul>
  <?php foreach($this->query->posts as $key => $post): ?>
    <li><?php print sprintf( '<a href="%s" rel="bookmark">%s</a>', '#answer-' . ($key == 0 ? 'list-legend' : $this->query->posts[$key-1]->ID), get_the_title($post)  ); ?></li>
  <?php endforeach; ?>
</ul>
<div>