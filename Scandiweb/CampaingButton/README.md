# Scandiweb - Task #2 - BE + FE 

* Magento 2.4 
* ES 6.4.2
* PHP 7.4



### Install process
1. Uncompress into app/code directory de zipCode.
2. Run a setup upgrade to install a module : $ bin/magento setup:upgrade 
3. Run a compile process : $ bin/magento setup:di:compile  
4. Run bon/magento c:f

 

  
### Resolutions of task 
The client wants to take steps to attract more customer for this he requested a new feature to changethe buttons color on the storefront. 

For give the client the freedom to manage this change without to do a ticket to us to do this change, i developed a module to manage this. This modulo get allowed two new command : 

1. First Command to change the button color : 
  - $ bin/magento scandiweb:color-change {HEX COLOR} {STORE_ID}
  - example :: $ bin/magento scandiweb:color-change FF9E00 2

2. Second command to remove the button color  . 
    - $ bin/magento scandiweb:remove-color-change {STORE_ID}
    - example :: $ bin/magento scandiweb:remove-color-change 2
