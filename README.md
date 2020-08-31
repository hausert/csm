# Scandiweb - Task #1 - Only BE 

* Magento 2.4 
* ES 6.4.2
* PHP 7.4



### Install process
1. Uncompress into app/code directory de zipCode.
2. Run a setup upgrade to install a module : $ bin/magento setup:upgrade 
3. Run a compile process : $ bin/magento setup:di:compile  
4. Run bon/magento c:f

 

  
### Resolutions of task 
Us assigned to task of resolved a SEO issue related a indexing in search engines. That produce because se merchant have a multistore, to fix this issue i created a new module to do next :

 The module check if the a Cms page was assigned to two or more store. If that is true render a link in to the head tag with all stores assigned with respective locale code.